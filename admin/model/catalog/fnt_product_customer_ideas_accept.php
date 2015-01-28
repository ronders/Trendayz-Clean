<?php
class ModelCatalogFntProductCustomerIdeasAccept extends Model {
	public function addIdeaAccept($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "fnt_product_customer_idea_accept SET product_customer_idea_id = '" . (int)$data['product_customer_idea_id'] . "', product_design_id = '" . (int)$data['product_design_id'] . "', image = '" . $this->db->escape($data['image']) . "', name = '" . $this->db->escape($data['name']) . "', customer_id = '" . (int)$data['customer_id'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
		$product_customer_idea_accept_id = $this->db->getLastId();
		$this->db->query("UPDATE " . DB_PREFIX . "fnt_product_customer_idea SET accept = 1 WHERE product_customer_idea_id = '" . (int)$data['product_customer_idea_id'] . "'");
		$query = $this->db->query("SELECT data_design FROM " . DB_PREFIX . "fnt_product_customer_idea WHERE product_customer_idea_id = '" . (int)$data['product_customer_idea_id'] . "'")->row;
		if($query){
			$this->db->query("UPDATE " . DB_PREFIX . "fnt_product_customer_idea_accept SET data_design = '" . $query['data_design'] . "' WHERE product_customer_idea_accept_id = '" . (int)$product_customer_idea_accept_id . "'");
		}
	}
	
	public function editProductIdeaAccept($data) {
		$this->db->query("UPDATE " . DB_PREFIX . "fnt_product_customer_idea_accept SET product_customer_idea_id = '" . (int)$data['product_customer_idea_id'] . "', image = '" . $this->db->escape($data['image']) . "', name = '" . $this->db->escape($data['name']) . "', status = '" . (int)$data['status'] . "', date_edit = NOW() WHERE product_customer_idea_accept_id = '" . (int)$data['product_customer_idea_accept_id'] . "'");
		$this->cache->delete('fnt_product_customer_idea_accept');
	}
	public function deleteProductIdeaAccept($product_customer_idea_accept_id) {
		$resutl = $this->getProductIdeaAccept($product_customer_idea_accept_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "fnt_product_customer_idea_accept WHERE product_customer_idea_accept_id = '" . (int)$product_customer_idea_accept_id . "'");
		if(!$this->getProductIdeaAcceptByCustomerIdea($resutl['product_customer_idea_id'])){
			$this->db->query("UPDATE " . DB_PREFIX . "fnt_product_customer_idea SET accept = 0 WHERE product_customer_idea_id = '" . (int)$resutl['product_customer_idea_id'] . "'");
		}
		$this->cache->delete('fnt_product_customer_idea_accept');
	}
	
	public function getProductIdeaAccept($product_customer_idea_accept_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "fnt_product_customer_idea_accept WHERE product_customer_idea_accept_id = '" . (int)$product_customer_idea_accept_id . "'");
				
		return $query->row;
	}
	
	public function getProductIdeaAcceptByCustomerIdea($product_customer_idea_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "fnt_product_customer_idea_accept WHERE product_customer_idea_id = '" . (int)$product_customer_idea_id . "'");
				
		return $query->row;
	}
	
	public function getProductIdeasAccept($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "fnt_product_customer_idea_accept WHERE data_design IS NOT NULL";
		if (!empty($data['filter_name'])) {
			$sql .= " AND name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		if (isset($data['filter_status']) && $data['filter_status'] !== null) {
			$sql .= " AND status = '" . (int)$data['filter_status'] . "'";
		}
		
		$sql .= " GROUP BY product_customer_idea_accept_id";
					
		$sort_data = array(
			'name',
			'status'
		);
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " DESC";
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
	
	public function getTotalProductIdeasAccept($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "fnt_product_customer_idea_accept WHERE data_design IS NOT NULL";
		if (!empty($data['filter_name'])) {
			$sql .= " AND name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		if (isset($data['filter_status']) && $data['filter_status'] !== null) {
			$sql .= " AND status = '" . (int)$data['filter_status'] . "'";
		}
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
}