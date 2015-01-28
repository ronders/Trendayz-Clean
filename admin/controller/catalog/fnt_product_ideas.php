<?php 
class ControllerCatalogFntProductIdeas extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('catalog/fnt_product_ideas');

		$this->document->setTitle($this->language->get('heading_title')); 

		$this->load->model('catalog/fnt_product_ideas');

		$this->getList();
	}

	public function insert() {
		$this->load->language('catalog/fnt_product_ideas');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_product_ideas');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
		
			$product_ideas_id = $this->model_catalog_fnt_product_ideas->addProductIdea($this->request->post);
		
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			if(isset($this->request->get['design'])){
				$this->redirect($this->url->link('catalog/fnt_custom_design', 'token=' . $this->session->data['token'] .'&product_ideas_id=' . $product_ideas_id));
			} else {
				$this->redirect($this->url->link('catalog/fnt_product_ideas', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('catalog/fnt_product_ideas');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_product_ideas');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {			
			$this->model_catalog_fnt_product_ideas->editProductIdea($this->request->get['product_ideas_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			if(isset($this->request->get['design'])){
				$this->redirect($this->url->link('catalog/fnt_custom_design', 'token=' . $this->session->data['token'] .'&product_ideas_id=' . $this->request->get['product_ideas_id']));
			} else {
				$this->redirect($this->url->link('catalog/fnt_product_ideas', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
			
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/fnt_product_ideas');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_product_ideas');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $product_ideas_id) {
				$this->model_catalog_fnt_product_ideas->deleteProductIdea($product_ideas_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/fnt_product_ideas', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	protected function getList() {
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}
		if (isset($this->request->get['filter_product_design'])) {
			$filter_product_design = $this->request->get['filter_product_design'];
		} else {
			$filter_product_design = null;
		}
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}
		$url = '';
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_product_design'])) {
			$url .= '&filter_product_design=' . urlencode(html_entity_decode($this->request->get['filter_product_design'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if (isset($this->request->get['order'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
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
			'href' => $this->url->link('catalog/fnt_product_ideas', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$this->data['insert'] = $this->url->link('catalog/fnt_product_ideas/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('catalog/fnt_product_ideas/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('catalog/fnt_product_ideas/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['products'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name, 
			'filter_product_design'	  => $filter_product_design, 
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);

		$this->load->model('tool/image');

		$product_design_total = $this->model_catalog_fnt_product_ideas->getTotalProductIdeas($filter_data);

		$results = $this->model_catalog_fnt_product_ideas->getProductIdeas($filter_data);
		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 100, 100);
			} else {
				$image = '';
			}
			$this->data['products'][] = array(
				'product_ideas_id' => $result['product_ideas_id'],
				'name'       => $result['name'],
				'image'      => $image,
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'edit'       => $this->url->link('catalog/fnt_product_ideas/update', 'token=' . $this->session->data['token'] . '&product_ideas_id=' . $result['product_ideas_id'] . $url, 'SSL')
			);
		}
		$this->data['heading_title'] = $this->language->get('heading_title');		

		$this->data['text_enabled'] = $this->language->get('text_enabled');			
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');	
		$this->data['text_confirm'] = $this->language->get('text_confirm');
		
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_status'] = $this->language->get('column_status');		
		$this->data['column_action'] = $this->language->get('column_action');		
		$this->data['column_image'] = $this->language->get('column_image');		

		$this->data['entry_name'] = $this->language->get('entry_name');			
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_product_design'] = $this->language->get('entry_product_design');
		$this->data['entry_filter'] = $this->language->get('entry_filter');

		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_edit'] = $this->language->get('button_edit');
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');

		$this->data['token'] = $this->session->data['token'];

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

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_product_design'])) {
			$url .= '&filter_product_design=' . urlencode(html_entity_decode($this->request->get['filter_product_design'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		$this->data['sort_name'] = $this->url->link('catalog/fnt_product_ideas', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/fnt_product_ideas', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/fnt_product_ideas', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_product_design'])) {
			$url .= '&filter_product_design=' . urlencode(html_entity_decode($this->request->get['filter_product_design'], ENT_QUOTES, 'UTF-8'));
		}
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		$pagination = new Pagination();
		$pagination->total = $product_design_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->url = $this->url->link('catalog/fnt_product_ideas', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_name'] = $filter_name;
		$this->data['filter_product_design'] = $filter_product_design;
		$this->data['filter_status'] = $filter_status;
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->template = 'catalog/fnt_product_ideas_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addScript('view/javascript/common-fancy.js');	
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_form'] = !isset($this->request->get['product_ideas_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_import'] = $this->language->get('text_import');
		$this->data['text_export'] = $this->language->get('text_export');
		
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_view_name'] = $this->language->get('entry_view_name');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['help_product'] = $this->language->get('help_product');
		
		$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_image'] = $this->language->get('tab_image');
		$this->data['tab_view'] = $this->language->get('tab_view');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_edit'] = $this->language->get('button_edit');
		$this->data['button_save_design'] = $this->language->get('button_save_design');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['button_image_add'] = $this->language->get('button_image_add');
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

		if (isset($this->error['product_design'])) {
			$this->data['error_product_design'] = $this->error['product_design'];
		} else {
			$this->data['error_product_design'] = '';
		}
		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_product_design'])) {
			$url .= '&filter_product_design=' . urlencode(html_entity_decode($this->request->get['filter_product_design'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
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
			'href' => $this->url->link('catalog/fnt_product_ideas', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['product_ideas_id'])) {
			$this->data['action'] = $this->url->link('catalog/fnt_product_ideas/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
			$this->data['tab_insert']=true;
		} else {
			$this->data['action'] = $this->url->link('catalog/fnt_product_ideas/update', 'token=' . $this->session->data['token'] . '&product_ideas_id=' . $this->request->get['product_ideas_id'] . $url, 'SSL');
			$this->data['update']=true;
		}

		$this->data['cancel'] = $this->url->link('catalog/fnt_product_ideas', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['product_ideas_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$product_ideas_info = $this->model_catalog_fnt_product_ideas->getProductIdea($this->request->get['product_ideas_id']);
		}

		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		if (isset($this->request->post['product_description'])){
			$this->data['product_description'] = $this->request->post['product_description'];
		} elseif(isset($this->request->get['product_ideas_id'])){
			$this->data['product_description'] = $this->model_catalog_fnt_product_ideas->getProductIdeasDescription($this->request->get['product_ideas_id']);
		} else {
			$this->data['product_description'] = array();
		}
		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($product_ideas_info)) {
			$this->data['image'] = $product_ideas_info['image'];
		} else {
			$this->data['image'] = 'no_image.jpg';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($product_ideas_info) && is_file(DIR_IMAGE . $product_ideas_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($product_ideas_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}


		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($product_ideas_info)) {
			$this->data['status'] = $product_ideas_info['status'];
		} else {
			$this->data['status'] = 1;
		}
		
		$this->load->model('catalog/fnt_product_design');

		if (isset($this->request->post['product_design_id'])) {
			$this->data['product_design_id'] = $this->request->post['product_design_id'];
		} elseif (!empty($product_ideas_info)) {
			$this->data['product_design_id'] = $product_ideas_info['product_design_id'];
		} else {
			$this->data['product_design_id'] = 0;
		}

		if (isset($this->request->post['product'])) {
			$this->data['product'] = $this->request->post['product'];
		} elseif (!empty($product_ideas_info)) {
			$product_info = $this->model_catalog_fnt_product_design->getProductDesign($product_ideas_info['product_design_id']);

			if ($product_info) {		
				$this->data['product'] = $product_info['name'];
			} else {
				$this->data['product'] = '';
			}	
		} else {
			$this->data['product'] = '';
		}
		//product idea image
		//end category design
		if (isset($this->request->post['product_image'])) {
			$product_images = $this->request->post['product_image'];
		} elseif (isset($this->request->get['product_ideas_id'])) {
			$product_images = $this->model_catalog_fnt_product_ideas->getTotalImageProductIdeas($this->request->get['product_ideas_id']);			
		} else {
			$product_images = array();
		}
		
		$this->load->model('tool/image');
		$this->data['product_images'] = array();
		foreach ($product_images as $product_image) {
			if (is_file(DIR_IMAGE . $product_image['image'])) {
				$image = $product_image['image'];
			} else {
				$image = '';
			}

			$this->data['product_images'][] = array(
				'product_ideas_element_id'  => $product_image['product_ideas_element_id'],
				'image'     			 	 => $image,
				'name'      				 => $product_image['name'],
				'edit'      				 => $this->url->link('catalog/fnt_custom_design','product_ideas_element_id=' . $product_image['product_ideas_element_id'] . '&token=' . $this->session->data['token'] . '&product_ideas_id=' . $this->request->get['product_ideas_id']),
				'thumb'   					 => $this->model_tool_image->resize($image, 100, 100),
				'sort_order'				 => $product_image['sort_order']
			);
		}
		if(isset($this->request->get['product_ideas_id'])){
			$this->data['product_ideas_id'] = $this->request->get['product_ideas_id'];
		} else {
			$this->data['product_ideas_id'] = 0;
		}
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		$this->template = 'catalog/fnt_product_ideas_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_product_ideas')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		foreach ($this->request->post['product_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}
		
		if (!(int)$this->request->post['product_design_id']) {
			$this->error['product_design'] = $this->language->get('error_product_design');
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_product_ideas')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/fnt_product_ideas');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 5;	
			}			

			$filter_data = array(
				'filter_name'  => $filter_name,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_fnt_product_ideas->getProductideas($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'product_ideas_id' => $result['product_ideas_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}
	public function export() {
		$this->load->model('catalog/fnt_product_ideas');
		if ( !isset($this->request->get['product_ideas_id']) )
			exit;
		$product_ideas_id = $this->request->get['product_ideas_id'];
		$products_design_element = $this->model_catalog_fnt_product_ideas->getProductIdeasElement($product_ideas_id);
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=fancy_product_'.$product_ideas_id.'.json');
		$output = '{';
		foreach($products_design_element as $view) {

			$output .= '"'.$view['product_ideas_element_id'].'": {';
			$output .= '"title": "'.$view['name'].'",';
			$elements = $this->model_catalog_fnt_product_ideas->getProductIdeasElementDetail($view['product_ideas_element_id']);	
			$temp = array();
			for($i=0; $i < sizeof($elements); $i++) {

				$source = $elements[$i]['value'];

				if($elements[$i]['type'] == 'image' && base64_encode(base64_decode(HTTP_CATALOG . 'image/' . $source, true)) !== $source) {

					$image_content = base64_encode($this->fpdGetFileContent(HTTP_CATALOG . 'image/' . $source));
					if($image_content !== false) {
						$image_type = explode(".", basename($source), 2);
						$image_type = $image_type[1];
						$elements[$i]['source'] = $image_type.','.$image_content;
					}

				} elseif($elements[$i]['type'] == 'text'){
					$elements[$i]['source'] = $source;
				}
				
				$temp[] = array(
					'type'	 	=> $elements[$i]['type'],
					'source'	=> $elements[$i]['source'],
					'parameters'=> unserialize($elements[$i]['parameters'])
				);
			}
			
			$output .= '"elements": '.stripslashes(json_encode($temp)).',';
			$output .= '"thumbnail_name": "'.basename($view['image']).'",';
			$thumbnail_content = base64_encode($this->fpdGetFileContent(stripslashes(HTTP_CATALOG . 'image/' . $view['image'])));
			$output .= '"thumbnail": "'.($thumbnail_content === false ? stripslashes($view->thumbnail) : $thumbnail_content).'"},';

		}
		$output = rtrim($output, ",");

		$output .= '}';

		echo $output;

		die;
	}
	//add a new view to a fancy product
	public function import() {
		$json = array();
		$thumbnail = trim($this->request->post['thumbnail']);
		$title = trim($this->request->post['title']);
		$product_ideas_id = trim($this->request->post['product_ideas_id']);
		$elements = isset($this->request->post['elements']) ? $this->request->post['elements'] : false;
		//check if thumbnail is base64 encoded, if yes, create and upload image to library image
		$thumbnail = $this->fntUploadBit($this->request->post['thumbnail_name'], $thumbnail);
		//check if elements are posted
		$this->load->model('catalog/fnt_product_ideas');
		if($elements !== false) {
			$product_ideas_element_id = $this->model_catalog_fnt_product_ideas->addviewIdeasByImport($product_ideas_id,$title,$thumbnail);
			//loop through all elements
			for($i=0;  $i < sizeof($elements); $i++) {

				$element = $elements[$i];

				if( $element['type'] == 'image' ) {
					//get parts of source string
					$image_parts = explode(',', $element['source']);
					$type = $image_parts[0]; //type of image
					$base64_image = $image_parts[1]; //the base 64 encoded image string
					if( !is_null($base64_image) && base64_encode(base64_decode($base64_image, true)) === $base64_image ) {
						$elements[$i]['source'] = $this->fntUploadBit($elements[$i]['parameters']['title_element'] . '.' . $image_parts[0], $base64_image);
					}
				}
				$elements[$i]['parameters'] = serialize($elements[$i]['parameters']);
				$this->model_catalog_fnt_product_ideas->addProductIdeasElement($product_ideas_element_id,$elements[$i],$i);
				
			}
			$sort_order = $this->model_catalog_fnt_product_ideas->getTotalProductIdeasImages($product_ideas_id);
			$json['success'] = $this->getViewListItem($product_ideas_id,$product_ideas_element_id, $title, $thumbnail,$sort_order - 1 ,$this->request->get['token']);
		}
		$this->response->setOutput(json_encode($json));
	}
	public function fpdGetFileContent( $file ) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $file);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$result = curl_exec($ch);
		curl_close($ch);

		//if curl does not work, use file_get_contents
		if( $result == false && function_exists('file_get_contents') ) {
			$result = @file_get_contents($file);
		}

		if($result !== false) {
			return $result;
		}
		else {
			return false;
		}

	}
	public function checkFileType( $filename, $mimes = null ) {
		if ( empty($mimes) )
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif' => 'image/gif',
			'png' => 'image/png'
		);
		$type = false;
		$ext = false;

		foreach ( $mimes as $ext_preg => $mime_match ) {
			$ext_preg = '!\.(' . $ext_preg . ')$!i';
			if ( preg_match( $ext_preg, $filename, $ext_matches ) ) {
				$type = $mime_match;
				$ext = $ext_matches[1];
				break;
			}
		}

		return compact( 'ext', 'type' );
	}
	public function fntUploadBit( $name, $bits) {
		$filetype = $this->checkFileType( $name );
		if ( ! $filetype['ext'])
			return -1;
		
		$new_file = DIR_IMAGE . 'data/image-import-fancy/';
		//create item dir
		if( !file_exists($new_file) )
			mkdir($new_file);

		$image_exist = file_exists($new_file . $name);
		$name =  $image_exist ? strtotime("now") . '-' . $name : $name; 
		$result = file_put_contents($new_file . $name, base64_decode($bits));
		return 'data/image-import-fancy/' . $name;
	}
	public function getViewListItem($product_ideas_id,$product_ideas_element_id, $title, $thumbnail, $sort_order, $token) {
		$this->load->model('tool/image');
		$this->load->language('catalog/fnt_product_ideas');
		$image = $this->model_tool_image->resize($thumbnail, 100, 100);
		$no_image = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		$html = '<tr id="image-row' . $sort_order . '"><td class="text-left">';
		$html .= '<img id="thumb' . $sort_order  . '" alt="" src="' . $image . '" class="img-thumbnail img-edit">';
		$html .= '<input type="hidden" id="image' . $sort_order  . '" value="' . $thumbnail . '" name="product_image[' . $sort_order  . '][image]"><br>';
		$html .= '<a onclick="image_upload(\'image' . $sort_order  . '\', \'thumb' . $sort_order  . '\');">' . $this->language->get('text_browse') . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
		$html .= '<a onclick="$(\'#thumb' . $sort_order  . '\').attr(\'src\', \'' . $no_image . '\'); $(\'#image' . $sort_order  . '\').attr(\'value\', \'\');">' . $this->language->get('text_clear') . '</a>';
		$html .= '<input type="hidden" value="' . $product_ideas_element_id . '" name="product_image[' . $sort_order . '][product_ideas_element_id]"></td>';
        $html .= '<td class="text-right"><input type="text" class="form-control" placeholder="' . $this->language->get('entry_view_name') . '" value="' . $title . '" name="product_image[' . $sort_order . '][name]"></td>';
       $html .= '<td class="text-left"><input type="text" class="form-control" placeholder="' . $this->language->get('entry_sort_order') . '" value="' . $sort_order . '" name="product_image[' . $sort_order . '][sort_order]"></td>';
	   $html .= '<td class="text-left"> <a title="" data-toggle="tooltip" class="btn btn-primary" href="index.php?route=catalog/fnt_custom_design&product_ideas_element_id='.$product_ideas_element_id.'&token=' . $token . '&product_ideas_id=' . $product_ideas_id . '" data-original-title="' .$this->language->get('text_edit') . '"><i class="fa fa-edit"></i> ' . $this->language->get('button_edit') . '</a>';
	   $html .= ' <button type="button" onclick="$(\'#image-row' . $sort_order . '\').remove();" class="btn btn-danger"><i class="fa fa-minus-circle"></i> ' . $this->language->get('button_remove') . '</button></td></tr>';
	return $html;
}
}