<?php
class ModelCatalogFntProductCustomerIdeas extends Model {

	public function deleteProductIdea($product_customer_idea_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "fnt_product_customer_idea WHERE product_customer_idea_id = '" . (int)$product_customer_idea_id . "'");
		$this->cache->delete('fnt_product_customer_idea');
	}
	
	public function getProductIdea($product_customer_idea_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "fnt_product_customer_idea WHERE product_customer_idea_id = '" . (int)$product_customer_idea_id . "'");
				
		return $query->row;
	}
	
	public function getProductIdeas($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "fnt_product_customer_idea WHERE data_design IS NOT NULL";
		if (!empty($data['filter_name'])) {
			$sql .= " AND name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		if (isset($data['filter_status']) && $data['filter_status'] !== null) {
			$sql .= " AND status = '" . (int)$data['filter_status'] . "'";
		}
		if (isset($data['filter_accept']) && $data['filter_accept'] !== null) {
			$sql .= " AND accept = '" . (int)$data['filter_accept'] . "'";
		}
		
		$sql .= " GROUP BY product_customer_idea_id";
					
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
	
	public function getTotalProductIdeas($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "fnt_product_customer_idea WHERE data_design IS NOT NULL";
		if (!empty($data['filter_name'])) {
			$sql .= " AND name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
		if (isset($data['filter_status']) && $data['filter_status'] !== null) {
			$sql .= " AND status = '" . (int)$data['filter_status'] . "'";
		}
		if (isset($data['filter_accept']) && $data['filter_accept'] !== null) {
			$sql .= " AND accept = '" . (int)$data['filter_accept'] . "'";
		}
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	
}