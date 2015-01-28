<?php 
class ControllerCatalogFntCategory extends Controller { 
	private $error = array();

	public function index() {
		$this->load->language('catalog/fnt_category');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_category');

		$this->getList();
	}

	public function insert() {
		$this->load->language('catalog/fnt_category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_category');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_fnt_category->addCategory($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/fnt_category', 'token=' . $this->session->data['token'] . $url, 'SSL')); 
		}
		$this->getForm();
	}

	public function update() {
		$this->load->language('catalog/fnt_category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_category');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_fnt_category->editCategory($this->request->get['category_design_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/fnt_category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/fnt_category');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_category');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $category_design_id) {
				$this->model_catalog_fnt_category->deleteCategory($category_design_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/fnt_category', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'separator' => ':',
			'href' => $this->url->link('catalog/fnt_category', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$this->data['insert'] = $this->url->link('catalog/fnt_category/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('catalog/fnt_category/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$this->data['categories'] = array();

		$filter_data = array(
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$category_clipart_total = $this->model_catalog_fnt_category->getTotalCategories();
		$results = $this->model_catalog_fnt_category->getCategories($filter_data);

		foreach ($results as $result) {
			$this->data['categories'][] = array(
				'category_design_id' => $result['category_design_id'],
				'name'        => $result['name'],
				'sort_order'  => $result['sort_order'],
				'edit'        => $this->url->link('catalog/fnt_category/update', 'token=' . $this->session->data['token'] . '&category_design_id=' . $result['category_design_id'] . $url, 'SSL'),
				'delete'      => $this->url->link('catalog/fnt_category/delete', 'token=' . $this->session->data['token'] . '&category_design_id=' . $result['category_design_id'] . $url, 'SSL')
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
		$pagination->url = $this->url->link('catalog/fnt_category', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();
		$this->template = 'catalog/fnt_category_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap_tooltip.js');
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
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
			'separator' => ':',
			'href' => $this->url->link('catalog/fnt_category', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['category_design_id'])) {
			$this->data['action'] = $this->url->link('catalog/fnt_category/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/fnt_category/update', 'token=' . $this->session->data['token'] . '&category_design_id=' . $this->request->get['category_design_id'], 'SSL');
		}

		$this->data['cancel'] = $this->url->link('catalog/fnt_category', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['category_design_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$category_clipart_info = $this->model_catalog_fnt_category->getCategory($this->request->get['category_design_id']);
		}

		$this->data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');
		$this->load->model('tool/image');
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['category_design_id'])) {
			$this->data['category_design_id'] = $this->request->post['category_design_id'];
		} elseif (isset($this->request->get['category_design_id'])) {
			$this->data['category_design_id'] = $this->model_catalog_fnt_category->getCategoryDescriptions($this->request->get['category_design_id']);
		} else {
			$this->data['category_design_id'] = array();
		}

		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($category_clipart_info)) {
			$this->data['sort_order'] = $category_clipart_info['sort_order'];
		} else {
			$this->data['sort_order'] = 0;
		}
		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($category_clipart_info)) {
			$this->data['keyword'] = $category_clipart_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($category_clipart_info)) {
			$this->data['status'] = $category_clipart_info['status'];
		} else {
			$this->data['status'] = 1;
		}
		
		if (isset($this->request->post['category_description'])) {
			$this->data['category_description'] = $this->request->post['category_description'];
		} elseif (!empty($category_clipart_info)) {
			$this->data['category_description'] = $this->model_catalog_fnt_category->getCategoryDescriptions($this->request->get['category_design_id']);
		} else {
			$this->data['category_description'] = array();
		}
		
		$this->template = 'catalog/fnt_category_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());		
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['category_description'] as $language_id => $value) {
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
		if (!$this->user->hasPermission('modify', 'catalog/fnt_category')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/fnt_category');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_catalog_fnt_category->getCategories($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'category_design_id' => $result['category_design_id'], 
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