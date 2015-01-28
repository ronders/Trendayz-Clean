<?php 
class ControllerCatalogFntCategoryClipart extends Controller { 
	private $error = array();

	public function index() {
		$this->load->language('catalog/fnt_category_clipart');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_category_clipart');

		$this->getList();
	}

	public function insert() {
		$this->load->language('catalog/fnt_category_clipart');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_category_clipart');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_fnt_category_clipart->addCategoryClipart($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/fnt_category_clipart', 'token=' . $this->session->data['token'] . $url, 'SSL')); 
		}
		$this->getForm();
	}

	public function update() {
		$this->load->language('catalog/fnt_category_clipart');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_category_clipart');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_fnt_category_clipart->editCategoryClipart($this->request->get['category_clipart_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/fnt_category_clipart', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/fnt_category_clipart');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_category_clipart');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $category_clipart_id) {
				$this->model_catalog_fnt_category_clipart->deleteCategoryClipart($category_clipart_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/fnt_category_clipart', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	protected function getList() {
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'separator' => false,
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'separator' => '/',
			'href' => $this->url->link('catalog/fnt_category_clipart', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$this->data['insert'] = $this->url->link('catalog/fnt_category_clipart/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('catalog/fnt_category_clipart/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$this->data['categories'] = array();

		$filter_data = array(
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$category_clipart_total = $this->model_catalog_fnt_category_clipart->getTotalCategoriesClipart();
		$results = $this->model_catalog_fnt_category_clipart->getCategoriesClipart($filter_data);

		foreach ($results as $result) {
			$this->data['categories'][] = array(
				'category_clipart_id' => $result['category_clipart_id'],
				'name'        => $result['name'],
				'sort_order'  => $result['sort_order'],
				'edit'        => $this->url->link('catalog/fnt_category_clipart/update', 'token=' . $this->session->data['token'] . '&category_clipart_id=' . $result['category_clipart_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('catalog/fnt_category_clipart/delete', 'token=' . $this->session->data['token'] . '&category_clipart_id=' . $result['category_clipart_id'] . $url, 'SSL')
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');
		
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_repair'] = $this->language->get('button_repair');
		$this->data['button_edit'] = $this->language->get('button_edit');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['text_confirm'] = $this->language->get('text_confirm');
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$this->data['selected'] = (array)$this->request->post['selected'];
		} else {
			$this->data['selected'] = array();
		}

		$pagination = new Pagination();
		$pagination->total = $category_clipart_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->url = $this->url->link('catalog/fnt_category_clipart', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();
		$this->template = 'catalog/fnt_category_clipart_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addScript('view/javascript/jquery/jscolor/jscolor.js');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_form'] = !isset($this->request->get['category_clipart_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_data'] = $this->language->get('tab_data');
		//entry
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_check'] = $this->language->get('text_check');
		$this->data['tab_setting'] = $this->language->get('tab_setting');
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_price'] = $this->language->get('entry_price');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['entry_clipart_parameter_x'] = $this->language->get('entry_clipart_parameter_x');
		$this->data['entry_clipart_parameter_y'] = $this->language->get('entry_clipart_parameter_y');
		$this->data['entry_clipart_parameter_z'] = $this->language->get('entry_clipart_parameter_z');
		$this->data['entry_clipart_parameter_scale'] = $this->language->get('entry_clipart_parameter_scale');
		$this->data['entry_clipart_parameter_colors'] = $this->language->get('entry_clipart_parameter_colors');
		$this->data['entry_clipart_parameter_price'] = $this->language->get('entry_clipart_parameter_price');
		$this->data['entry_clipart_parameter_auto_center'] = $this->language->get('entry_clipart_parameter_auto_center');
		$this->data['entry_clipart_parameter_draggable'] = $this->language->get('entry_clipart_parameter_draggable');
		$this->data['entry_clipart_parameter_rotatable'] = $this->language->get('entry_clipart_parameter_rotatable');
		$this->data['entry_clipart_parameter_resizable'] = $this->language->get('entry_clipart_parameter_resizable');
		$this->data['entry_clipart_parameter_replace'] = $this->language->get('entry_clipart_parameter_replace');
		$this->data['entry_clipart_parameter_stay_to_top'] = $this->language->get('entry_clipart_parameter_stay_to_top');
		$this->data['entry_clipart_parameter_auto_select'] = $this->language->get('entry_clipart_parameter_auto_select');
		$this->data['entry_clipart_parameter_zChangeable'] = $this->language->get('entry_clipart_parameter_zChangeable');
		$this->data['entry_clipart_parameter_removable'] = $this->language->get('entry_clipart_parameter_removable');
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

		if (isset($this->error['meta_title'])) {
			$this->data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$this->data['error_meta_title'] = array();
		}	

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'separator' => false,
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'separator' => '/',
			'href' => $this->url->link('catalog/fnt_category_clipart', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['category_clipart_id'])) {
			$this->data['action'] = $this->url->link('catalog/fnt_category_clipart/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/fnt_category_clipart/update', 'token=' . $this->session->data['token'] . '&category_clipart_id=' . $this->request->get['category_clipart_id'], 'SSL');
		}

		$this->data['cancel'] = $this->url->link('catalog/fnt_category_clipart', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['category_clipart_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$category_clipart_info = $this->model_catalog_fnt_category_clipart->getCategoryClipart($this->request->get['category_clipart_id']);
		}

		$this->data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');
		$this->load->model('tool/image');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['category_clipart_id'])) {
			$this->data['category_clipart_id'] = $this->request->post['category_clipart_id'];
		} elseif (isset($this->request->get['category_clipart_id'])) {
			$this->data['category_clipart_id'] = $this->model_catalog_fnt_category_clipart->getCategoryClipartDescriptions($this->request->get['category_clipart_id']);
		} else {
			$this->data['category_clipart_id'] = array();
		}

		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($category_clipart_info)) {
			$this->data['sort_order'] = $category_clipart_info['sort_order'];
		} else {
			$this->data['sort_order'] = 0;
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($category_clipart_info)) {
			$this->data['status'] = $category_clipart_info['status'];
		} else {
			$this->data['status'] = 1;
		}
		
		if (isset($this->request->post['category_clipart_description'])) {
			$this->data['category_clipart_description'] = $this->request->post['category_clipart_description'];
		} elseif (!empty($category_clipart_info)) {
			$this->data['category_clipart_description'] = $this->model_catalog_fnt_category_clipart->getCategoryClipartDescriptions($this->request->get['category_clipart_id']);
		} else {
			$this->data['category_clipart_description'] = array();
		}
		
		if (isset($this->request->post['parameter'])) {
			$this->data['parameter'] = $this->request->post['parameter'];
		} elseif (!empty($category_clipart_info)) {
			$this->data['parameter'] = unserialize($category_clipart_info['parameter']);
		} else {
			$this->data['parameter'] = array(
				'x' 		  => 0,
				'y' 		  => 0,
				'z' 		  => -1,
				'scale'       => 1,
				'colors'	  => '#ffffff',
				'price' 	  => 0,
				'auto_center' => 1,
				'draggable'   => 1,
				'rotatable'   => 1,
				'resizable'   => 1,
				'replace'  	  => '',
				'auto_select' => 0,
				'stay_to_top' => 0,
				'zChangeable' => 1,
				'removable'   => 1,
				'status'      => 0
			);	
		}
		$this->template = 'catalog/fnt_category_clipart_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());		
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_category_clipart')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['category_clipart_description'] as $language_id => $value) {
			if ((utf8_strlen($value) < 2) || (utf8_strlen($value) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_category_clipart')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/fnt_category_clipart');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_catalog_fnt_category_clipart->getCategoriesClipart($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'category_clipart_id' => $result['category_clipart_id'], 
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}		
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->setOutput(json_encode($json));
	}		
}