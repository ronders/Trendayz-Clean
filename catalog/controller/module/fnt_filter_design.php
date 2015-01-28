<?php
class ControllerModuleFntFilterDesign extends Controller {
	protected function index() {
		$this->language->load('module/fnt_filter_design');
		
      	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->load->model('catalog/fnt_product_design');
		
		$this->load->model('tool/image');
		
		$this->data['products'] = array();
		
		$data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0
		);

		$results = $this->model_catalog_fnt_product_design->getProducts($data);
		foreach ($results as $result) {
			if (file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
				$image_popup = $this->model_tool_image->resize($result['image'], 230, 230);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
				$image_popup = $this->model_tool_image->resize('no_image.jpg', 230, 230);
			}
			
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}
					
			if ((float)$result['special']) {
				$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$special = false;
			}
			
			if ($this->config->get('config_review_status')) {
				$rating = $result['rating'];
			} else {
				$rating = false;
			}
			
			$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'thumb'   	 => $image,
				'image_popup'=> $image_popup,
				'name'    	 => $result['name'],
				'price'   	 => $price,
				'special' 	 => $special,
				'rating'     => $rating,
				'href'    	 => $this->url->link('product/fnt_product_design', 'product_design_id=' . $result['product_design_id']),
			);
		}
	
		$this->data['categories'] = array();
		$categories = $this->model_catalog_fnt_product_design->getCategories(0);
		
		foreach ($categories as $category) {
			$this->data['categories'][] = array(
				'name'     => $category['name'],
				'children' => $this->getChildrenCategory($category, $category['category_id']),
				'href'     => $this->url->link('product/category', 'path=' . $category['category_id']),
				'category_id' => $category['category_id']
			);
		}
		$this->data['manufacturers'] = array();
									
		$manufacturers = $this->model_catalog_fnt_product_design->getManufacturers();
	
		foreach ($manufacturers as $result) {
			$this->data['manufacturers'][] = array(
				'name' => $result['name'],
				'manufacturer_id' => $result['manufacturer_id']
			);
		}
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/fnt_filter_design.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/fnt_filter_design.tpl';
		} else {
			$this->template = 'default/template/module/fnt_filter_design.tpl';
		}

		$this->render();
	}
	private function getChildrenCategory($category, $path)
	{
		$children_data = array();
		$children = $this->model_catalog_category->getCategories($category['category_id']);
		
		foreach ($children as $child) {
			$data = array(
				'filter_category_id'  => $child['category_id'],
				'filter_sub_category' => true	
			);		
        $children_data[] = array(
          'name'  => $child['name'],
          'category_id'  => $child['category_id'],
          'children' => $this->getChildrenCategory($child, $path . '_' . $child['category_id']),
          'column'   => 1,
          'href'  => $this->url->link('product/category', 'path=' . $path . '_' . $child['category_id'])	
        );
	}
		return $children_data;
	}
}
?>