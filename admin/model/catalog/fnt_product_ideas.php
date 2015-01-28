<?php
class ModelCatalogFntProductIdeas extends Model {
	public function addProductIdea($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "fnt_product_ideas SET product_design_id = '" . (int)$data['product_design_id'] . "', image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
		$product_ideas_id = $this->db->getLastId();
		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "fnt_product_ideas_description SET product_ideas_id = '" . (int)$product_ideas_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
		
		$ideas_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "fnt_product_design_element WHERE product_design_id = '" .(int)$data['product_design_id']."'");	
			
		if($ideas_info){
			foreach ($ideas_info->rows as $idea_info) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "fnt_product_ideas_element SET name = '" . $this->db->escape($idea_info['name']) . "',product_ideas_id = '" . (int)$product_ideas_id . "', image = '" . $this->db->escape($idea_info['image']) . "',sort_order= '".(int)$idea_info['sort_order'] . "'");
				$product_ideas_element_id = $this->db->getLastId();				
				$ideas_element_details = $this->db->query("SELECT * FROM " . DB_PREFIX . "fnt_product_design_element_detail WHERE product_design_element_id = '" .(int)$idea_info['product_design_element_id']."'");				
				if ($ideas_element_details) {
				foreach ($ideas_element_details->rows as $ideas_element_detail) {			
					$this->db->query("INSERT INTO " . DB_PREFIX . "fnt_product_ideas_element_detail SET product_ideas_element_id = '" .(int)$product_ideas_element_id . "',type = '" . $this->db->escape($ideas_element_detail['type']) . "', value = '" . $this->db->escape($ideas_element_detail['value']) . "',parameters = '" . $this->db->escape($ideas_element_detail['parameters']) . "',sort_order= '".(int)$ideas_element_detail['sort_order'] . "'");				
				}
			}
			}			
		}
		$this->cache->delete('fnt_product_ideas');
		return $product_ideas_id;
	}
	
	public function editProductIdea($product_ideas_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "fnt_product_ideas SET product_design_id = '" . (int)$data['product_design_id'] . "', image = '" . $this->db->escape($data['image']) . "', status = '" . (int)$data['status'] . "' WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "fnt_product_ideas_description WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "fnt_product_ideas_element WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		foreach ($data['product_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "fnt_product_ideas_description SET product_ideas_id = '" . (int)$product_ideas_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
		
		if (isset($data['product_image'])) {
			foreach ($data['product_image'] as $image) {
				if(isset($image['product_ideas_element_id']) && $image['product_ideas_element_id']){
					$this->db->query("INSERT INTO " . DB_PREFIX . "fnt_product_ideas_element SET product_ideas_element_id = '" . (int)$image['product_ideas_element_id'] . "', product_ideas_id = '" . (int)$product_ideas_id . "', name = '" . $this->db->escape($image['name']) . "', image = '" . $this->db->escape($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "fnt_product_ideas_element SET product_ideas_id = '" . (int)$product_ideas_id . "', name = '" . $this->db->escape($image['name']) . "', image = '" . $this->db->escape($image['image']) . "', sort_order = '" . (int)$image['sort_order'] . "'");
				}
			}
		}	
		$this->cache->delete('fnt_product_ideas');
	}
	
	public function deleteProductIdea($product_ideas_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "fnt_product_ideas WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "fnt_product_ideas_description WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		$product_ideas = $this->db->query("SELECT product_ideas_element_id FROM " . DB_PREFIX ."fnt_product_ideas_element WHERE product_ideas_id ='".(int)$product_ideas_id."'");
		if ($product_ideas) {
			foreach ($product_ideas->rows as $product_idea) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "fnt_product_ideas_element_detail WHERE product_ideas_element_id = '" . (int)$product_idea['product_ideas_element_id'] . "'");
			}
		}
		$this->db->query("DELETE FROM " . DB_PREFIX . "fnt_product_ideas_element WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		$this->cache->delete('fnt_product_ideas');
	}
	
	public function getProductIdea($product_ideas_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "fnt_product_ideas WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
				
		return $query->row;
	}
	
	public function getProductIdeas($data = array()) {
		$sql = "SELECT pi.*,pid.* FROM " . DB_PREFIX . "fnt_product_ideas pi LEFT JOIN " . DB_PREFIX . "fnt_product_ideas_description pid ON (pi.product_ideas_id = pid.product_ideas_id)";
		if (!empty($data['filter_product_design']) || !empty($data['filter_product_design_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "fnt_product_design pd ON (pi.product_design_id = pd.product_design_id)";
		}
		$sql .= " WHERE pid.language_id =  '" . (int)$this->config->get('config_language_id') . "'";
		if (!empty($data['filter_name'])) {
			$sql .= " AND pid.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		if (!empty($data['filter_product_design'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_product_design']) . "%'";
		}
		if (!empty($data['filter_product_design_id'])) {
			$sql .= " AND pd.product_design_id = '" . (int)$data['filter_product_design_id'] . "'";
		}
		if (isset($data['filter_status']) && $data['filter_status'] !== null) {
			$sql .= " AND pi.status = '" . (int)$data['filter_status'] . "'";
		}
		
		$sql .= " GROUP BY pi.product_ideas_id";
					
		$sort_data = array(
			'name',
			'status'
		);
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
		
		$query = $this->db->query($sql);
	
		return $query->rows;
	}
	
	public function addProductIdeasElement($product_ideas_element_id,$data,$sort_order){
		$query = $this->db->query("INSERT INTO " . DB_PREFIX . "fnt_product_ideas_element_detail SET product_ideas_element_id = '" . (int)$product_ideas_element_id . "', type = '" . $this->db->escape($data['type']) . "', value = '" . $this->db->escape($data['source']) . "', parameters = '" . $this->db->escape($data['parameters']) . "', sort_order = '" . (int)$sort_order . "'");
	}
	
	public function getProductIdeasDescription($product_ideas_id){
		$product_description = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fnt_product_ideas_description WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		foreach ($query->rows as $value) {
			$product_description[$value['language_id']] = array(
				'name' =>  $value['name']
			);
		}
		return $product_description;
	}
	public function getProductIdeaElement($product_ideas_element_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fnt_product_ideas_element WHERE product_ideas_element_id = '" . (int)$product_ideas_element_id . "'");
		return $query->row;
	}
	
	public function getProductIdeasElement($product_ideas_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fnt_product_ideas_element WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		return $query->rows;
	}
	
	public function getTotalProductIdeasImages($product_ideas_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "fnt_product_ideas_element WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		return $query->row['total'];
	}
	public function getProductIdeaFirstImage($product_ideas_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fnt_product_ideas_element WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		return $query->row;
	}
	public function getProductIdeasElementDetail($product_ideas_element_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fnt_product_ideas_element_detail WHERE product_ideas_element_id = '" . (int)$product_ideas_element_id . "' ORDER BY sort_order ASC");
		return $query->rows;
	}

	public function deleteProductIdeasElement($product_ideas_element_id){
		$query = $this->db->query("DELETE FROM " . DB_PREFIX . "fnt_product_ideas_element_detail WHERE product_ideas_element_id = '" . (int)$product_ideas_element_id . "'");
	}
	public function getTotalProductIdeas($data = array()) {
		$sql = "SELECT COUNT(DISTINCT product_ideas_id) AS total FROM " . DB_PREFIX . "fnt_product_ideas WHERE product_ideas_id != 0";
		
		if (isset($data['filter_status']) && $data['filter_status'] !== null) {
			$sql .= " AND status = '" . (int)$data['filter_status'] . "'";
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
	public function getTotalImageProductIdeas($product_ideas_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "fnt_product_ideas_element WHERE product_ideas_id = '" .(int)$product_ideas_id . "' ORDER BY sort_order ASC");		
		return $query->rows;		
	}
	public function addviewIdeasByImport($product_ideas_id,$title,$thumbnail){
		$total_view = $this->getMaxSortOrderOfView($product_ideas_id);
		$this->db->query("INSERT INTO " . DB_PREFIX . "fnt_product_ideas_element SET product_ideas_id = '" . (int)$product_ideas_id . "', name = '" . $this->db->escape($title) . "', image = '" . $this->db->escape($thumbnail) . "', sort_order = '" . (int)$total_view . "'");
		return  $this->db->getLastId();
	}
	
	public function getMaxSortOrderOfView($product_ideas_id){
		$query = $this->db->query("SELECT MAX(sort_order) AS max_order FROM " . DB_PREFIX . "fnt_product_ideas_element WHERE product_ideas_id = '" . (int)$product_ideas_id . "'");
		
		return $query->row['max_order']+1;
	}
}