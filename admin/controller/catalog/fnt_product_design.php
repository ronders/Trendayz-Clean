<?php 
class ControllerCatalogFntProductDesign extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('catalog/fnt_product_design');

		$this->document->setTitle($this->language->get('heading_title')); 

		$this->load->model('catalog/fnt_product_design');

		$this->getList();
	}

	public function insert() {
		$this->load->language('catalog/fnt_product_design');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_product_design');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
		
			$product_design_id = $this->model_catalog_fnt_product_design->addProductDesign($this->request->post);

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
				$this->redirect($this->url->link('catalog/fnt_custom_design', 'token=' . $this->session->data['token'] .'&product_design_id=' . $product_design_id));
			} else {
				$this->redirect($this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('catalog/fnt_product_design');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_product_design');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_fnt_product_design->editProductDesign($this->request->get['product_design_id'], $this->request->post);

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
				$this->redirect($this->url->link('catalog/fnt_custom_design', 'token=' . $this->session->data['token'] .'&product_design_id=' . $this->request->get['product_design_id']));
			} else {
				$this->redirect($this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'] . $url, 'SSL'));
			}
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/fnt_product_design');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_product_design');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $product_design_id) {
				$this->model_catalog_fnt_product_design->deleteProductDesign($product_design_id);
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

			$this->redirect($this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$this->data['insert'] = $this->url->link('catalog/fnt_product_design/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('catalog/fnt_product_design/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('catalog/fnt_product_design/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['products'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name, 
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);

		$this->load->model('tool/image');

		$product_design_total = $this->model_catalog_fnt_product_design->getTotalProductDesigns($filter_data);

		$results = $this->model_catalog_fnt_product_design->getProductDesigns($filter_data);

		foreach ($results as $result) {
			$this->data['products'][] = array(
				'product_design_id' => $result['product_design_id'],
				'name'       => $result['name'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'edit'       => $this->url->link('catalog/fnt_product_design/update', 'token=' . $this->session->data['token'] . '&product_design_id=' . $result['product_design_id'] . $url, 'SSL')
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

		$this->data['entry_name'] = $this->language->get('entry_name');		
		$this->data['entry_status'] = $this->language->get('entry_status');

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

		$this->data['sort_name'] = $this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

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
		$pagination = new Pagination();
		$pagination->total = $product_design_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->url = $this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();
		$this->data['filter_name'] = $filter_name;
		$this->data['filter_status'] = $filter_status;
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->template = 'catalog/fnt_product_design_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap_tooltip.js');
		$this->document->addScript('view/javascript/common-fancy.js');
		$this->document->addScript('view/javascript/jquery/jscolor/jscolor.js');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_form'] = !isset($this->request->get['product_design_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_edit'] = $this->language->get('text_edit');
		$this->data['text_import'] = $this->language->get('text_import');
		$this->data['text_export'] = $this->language->get('text_export');
		$this->data['text_individual_setting'] = $this->language->get('text_individual_setting');
		$this->data['text_des_individual_setting'] = $this->language->get('text_des_individual_setting');
		$this->data['text_custom_control'] = $this->language->get('text_custom_control');		
		$this->data['text_custom_image'] = $this->language->get('text_custom_image');
		$this->data['text_background_type_image'] = $this->language->get('text_background_type_image');
		$this->data['text_background_type_color'] = $this->language->get('text_background_type_color');
		$this->data['text_background_type_none'] = $this->language->get('text_background_type_none');
		$this->data['text_use_option_main_setting'] = $this->language->get('text_use_option_main_setting');
		$this->data['text_custom_bounding_box'] = $this->language->get('text_custom_bounding_box');
		$this->data['text_use_another_element_as_bounding_box'] = $this->language->get('text_use_another_element_as_bounding_box');
		
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_price'] = $this->language->get('entry_price');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_view_name'] = $this->language->get('entry_view_name');
		$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_category_design'] = $this->language->get('entry_category_design');
		$this->data['entry_theme'] = $this->language->get('entry_theme');
		$this->data['entry_view_selection_floated'] = $this->language->get('entry_view_selection_floated');
		$this->data['entry_stage_width'] = $this->language->get('entry_stage_width');
		$this->data['entry_stage_height'] = $this->language->get('entry_stage_height');
		$this->data['entry_background_type'] = $this->language->get('entry_background_type');
		$this->data['entry_background_image'] = $this->language->get('entry_background_image');
		$this->data['entry_background_color'] = $this->language->get('entry_background_color');
		$this->data['entry_hide_designs_tab'] = $this->language->get('entry_hide_designs_tab');
		$this->data['entry_hide_facebook_tab'] = $this->language->get('entry_hide_facebook_tab');
		$this->data['entry_hide_instagram_tab'] = $this->language->get('entry_hide_instagram_tab');
		$this->data['entry_hide_custom_image_upload'] = $this->language->get('entry_hide_custom_image_upload');
		$this->data['entry_hide_custom_text'] = $this->language->get('entry_hide_custom_text');
		$this->data['entry_designs_parameter_price'] = $this->language->get('entry_designs_parameter_price');
		$this->data['entry_designs_parameter_replace'] = $this->language->get('entry_designs_parameter_replace');
		$this->data['entry_designs_parameter_bounding_box_control'] = $this->language->get('entry_designs_parameter_bounding_box_control');
		$this->data['entry_designs_parameter_bounding_box_x'] = $this->language->get('entry_designs_parameter_bounding_box_x');
		$this->data['entry_designs_parameter_bounding_box_y'] = $this->language->get('entry_designs_parameter_bounding_box_y');
		$this->data['entry_designs_parameter_bounding_box_width'] = $this->language->get('entry_designs_parameter_bounding_box_width');
		$this->data['entry_designs_parameter_bounding_box_height'] = $this->language->get('entry_designs_parameter_bounding_box_height');
		$this->data['entry_designs_parameter_bounding_box_by_other'] = $this->language->get('entry_designs_parameter_bounding_box_by_other');
		$this->data['entry_uploaded_designs_parameter_minW'] = $this->language->get('entry_uploaded_designs_parameter_minW');
		$this->data['entry_uploaded_designs_parameter_minH'] = $this->language->get('entry_uploaded_designs_parameter_minH');
		$this->data['entry_uploaded_designs_parameter_maxW'] = $this->language->get('entry_uploaded_designs_parameter_maxW');
		$this->data['entry_uploaded_designs_parameter_maxH'] = $this->language->get('entry_uploaded_designs_parameter_maxH');
		$this->data['entry_uploaded_designs_parameter_resizeToW'] = $this->language->get('entry_uploaded_designs_parameter_resizeToW');
		$this->data['entry_uploaded_designs_parameter_resizeToH'] = $this->language->get('entry_uploaded_designs_parameter_resizeToH');
		$this->data['entry_custom_texts_parameter_bounding_box_control'] = $this->language->get('entry_custom_texts_parameter_bounding_box_control');
		$this->data['entry_custom_texts_parameter_bounding_box_x'] = $this->language->get('entry_custom_texts_parameter_bounding_box_x');
		$this->data['entry_custom_texts_parameter_bounding_box_y'] = $this->language->get('entry_custom_texts_parameter_bounding_box_y');
		$this->data['entry_custom_texts_parameter_bounding_box_width'] = $this->language->get('entry_custom_texts_parameter_bounding_box_width');
		$this->data['entry_custom_texts_parameter_bounding_box_height'] = $this->language->get('entry_custom_texts_parameter_bounding_box_height');
		$this->data['entry_custom_texts_parameter_bounding_box_by_other'] = $this->language->get('entry_custom_texts_parameter_bounding_box_by_other');
		$this->data['entry_default_text'] = $this->language->get('entry_default_text');
		$this->data['entry_custom_texts_parameter_price'] = $this->language->get('entry_custom_texts_parameter_price');
		$this->data['entry_custom_texts_parameter_colors'] = $this->language->get('entry_custom_texts_parameter_colors');
		
		$this->data['help_category'] = $this->language->get('help_category');	
		$this->data['help_product'] = $this->language->get('help_product');
		
		$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_view'] = $this->language->get('tab_view');
		$this->data['tab_setting'] = $this->language->get('tab_setting');
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_image_parameter'] = $this->language->get('tab_image_parameter');
		$this->data['tab_custom_text_parameter'] = $this->language->get('tab_custom_text_parameter');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_save_design'] = $this->language->get('button_save_design');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_image_add'] = $this->language->get('button_image_add');
		$this->data['button_edit'] = $this->language->get('button_edit');
		$this->data['button_remove'] = $this->language->get('button_remove');
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

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'separator' => false,
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'separator' => ':',
			'href' => $this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['product_design_id'])) {
			$this->data['action'] = $this->url->link('catalog/fnt_product_design/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/fnt_product_design/update', 'token=' . $this->session->data['token'] . '&product_design_id=' . $this->request->get['product_design_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'] . $url, 'SSL');
		if(isset($this->request->get['product_design_id'])){
			$this->data['product_design_id'] = $this->request->get['product_design_id'];
		} else {
			$this->data['product_design_id'] = 0;
		}	
		if (isset($this->request->get['product_design_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$product_design_info = $this->model_catalog_fnt_product_design->getProductDesign($this->request->get['product_design_id']);
		}

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} elseif (!empty($product_design_info)) {
			$this->data['name'] = $product_design_info['name'];
		} else {
			$this->data['name'] = '';
		}
		

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($product_design_info)) {
			$this->data['status'] = $product_design_info['status'];
		} else {
			$this->data['status'] = 1;
		}
		
		$this->load->model('catalog/product');

		if (isset($this->request->post['product_id'])) {
			$this->data['product_id'] = $this->request->post['product_id'];
		} elseif (!empty($product_design_info)) {
			$this->data['product_id'] = $product_design_info['product_id'];
		} else {
			$this->data['product_id'] = 0;
		}

		if (isset($this->request->post['product'])) {
			$this->data['product'] = $this->request->post['product'];
		} elseif (!empty($product_design_info)) {
			$product_info = $this->model_catalog_product->getProduct($product_design_info['product_id']);

			if ($product_info) {		
				$this->data['product'] = $product_info['name'];
			} else {
				$this->data['product'] = '';
			}	
		} else {
			$this->data['product'] = '';
		}
		
		// Categories
		$this->load->model('catalog/fnt_category_clipart');

		if (isset($this->request->post['category_clipart'])) {
			$categories = $this->request->post['category_clipart'];
		} elseif (isset($this->request->get['product_design_id'])) {		
			$categories = $this->model_catalog_fnt_product_design->getProductDesignCategories($this->request->get['product_design_id']);
		} else {
			$categories = array();
		}

		$this->data['clipart_categories'] = array();
		foreach ($categories as $category_clipart_id) {
			$category_info = $this->model_catalog_fnt_category_clipart->getCategoryClipartDescriptions($category_clipart_id);
			if ($category_info) {
				$this->data['clipart_categories'][] = array(
					'category_clipart_id' => $category_clipart_id,
					'name'                => $category_info[(int)$this->config->get('config_language_id')]
				);
			}
		}
		// Categories Design
		$this->load->model('catalog/fnt_category');

		if (isset($this->request->post['category_design'])) {
			$categories_design = $this->request->post['category_design'];
		} elseif (isset($this->request->get['product_design_id'])) {		
			$categories_design = $this->model_catalog_fnt_product_design->getProductCategories($this->request->get['product_design_id']);
		} else {
			$categories_design = array();
		}

		$this->data['categories_design'] = array();
		foreach ($categories_design as $category_design_id) {
			$category_info = $this->model_catalog_fnt_category->getCategoryDescriptions($category_design_id);
			//print_r($category_info);die();
			if ($category_info) {
				$this->data['categories_design'][] = array(
					'category_design_id' => $category_design_id,
					'name'                => $category_info[(int)$this->config->get('config_language_id')]
				);
			}
		}
		//end category design
		if (isset($this->request->post['product_image'])) {
			$product_images = $this->request->post['product_image'];
		} elseif (isset($this->request->get['product_design_id'])) {
			$product_images = $this->model_catalog_fnt_product_design->getProductDesignImages($this->request->get['product_design_id']);
		} else {
			$product_images = array();
		}
		
		
		$this->load->model('tool/image');
		$this->data['product_images'] = array();
		foreach ($product_images as $product_image) {
			if (is_file(DIR_IMAGE . $product_image['image'])) {
				$image = $product_image['image'];
			} else {
				$image = 'no_image.jpg';
			}
		
			$this->data['product_images'][] = array(
				'product_design_element_id'  => $product_image['product_design_element_id'],
				'image'     			 	 => $image,
				'name'      				 => $product_image['name'],
				'edit'      				 => $this->url->link('catalog/fnt_custom_design','product_design_element_id=' . $product_image['product_design_element_id'] . '&token=' . $this->session->data['token'] . '&product_design_id=' . $this->request->get['product_design_id']),
				'thumb'   					 => $this->model_tool_image->resize($image, 100, 100),
				'sort_order'				 => $product_image['sort_order']
			);
		}
		$parameters_info = $this->model_catalog_fnt_product_design->getParametersByProduct($this->data['product_design_id']);
		if (isset($this->request->post['parameters'])) {
			$this->data['parameters'] = $this->request->post['parameters'];
		}elseif($parameters_info){
			$this->data['parameters'] = unserialize($parameters_info['parameters']);
		} else {
			$this->data['parameters'] = array();
			$this->data['parameters']['layout'] = $this->config->get('config_theme');
			$this->data['parameters']['view_selection_floated'] = $this->config->get('config_view_selection_float');
			$this->data['parameters']['stage_width'] = $this->config->get('config_stage_width');
			$this->data['parameters']['stage_height'] = $this->config->get('config_stage_height');
			$this->data['parameters']['designs_parameter_price'] = $this->config->get('config_designs_parameter_price');
			$this->data['parameters']['designs_parameter_replace'] = $this->config->get('config_designs_parameter_replace');
			$this->data['parameters']['designs_parameter_bounding_box_x'] = $this->config->get('config_bounding_box_x');
			$this->data['parameters']['designs_parameter_bounding_box_y'] = $this->config->get('config_bounding_box_y');
			$this->data['parameters']['designs_parameter_bounding_box_width'] = $this->config->get('config_bounding_box_width');
			$this->data['parameters']['designs_parameter_bounding_box_height'] = $this->config->get('config_bounding_box_height');
			$this->data['parameters']['uploaded_designs_parameter_minW'] = $this->config->get('config_min_width');
			$this->data['parameters']['uploaded_designs_parameter_minH'] = $this->config->get('config_min_height');
			$this->data['parameters']['uploaded_designs_parameter_maxW'] = $this->config->get('config_max_width');
			$this->data['parameters']['uploaded_designs_parameter_maxH'] = $this->config->get('config_max_height');
			$this->data['parameters']['uploaded_designs_parameter_resizeToW'] = $this->config->get('config_resize_width');
			$this->data['parameters']['uploaded_designs_parameter_resizeToH'] = $this->config->get('config_resize_height');
			$this->data['parameters']['designs_parameter_bounding_box_by_other'] = $this->config->get('config_bounding_box_target');
			$this->data['parameters']['custom_texts_parameter_price'] = $this->config->get('config_text_design_price');
			$this->data['parameters']['custom_texts_parameter_replace'] = $this->config->get('config_text_replace');
			$this->data['parameters']['custom_texts_parameter_bounding_box_x'] = $this->config->get('config_text_bounding_x_position');
			$this->data['parameters']['custom_texts_parameter_bounding_box_y'] = $this->config->get('config_text_bounding_y_position');
			$this->data['parameters']['custom_texts_parameter_bounding_box_width'] = $this->config->get('config_text_bounding_width');
			$this->data['parameters']['custom_texts_parameter_bounding_box_height'] = $this->config->get('config_text_bounding_height');
			$this->data['parameters']['custom_texts_parameter_bounding_box_by_other'] = $this->config->get('config_text_bounding_box_target');
			$this->data['parameters']['default_text'] = $this->config->get('config_text_default');
			$this->data['parameters']['custom_texts_parameter_colors'] = $this->config->get('config_text_design_color');
		}
		if(isset($this->data['parameters']['image']) && $this->data['parameters']['image']){
			$this->data['thumb_background'] = $this->model_tool_image->resize($this->data['parameters']['image'], 100, 100);
		} else {
			$this->data['thumb_background'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}	
		$this->data['themes'][] = array('value'=>'','title' => $this->language->get('text_use_default'));
		$this->data['themes'][] = array('value'=>'icon-sb-top','title' => $this->language->get('text_flat_top_sidebar'));
		$this->data['themes'][] = array('value'=>'icon-sb-bottom','title' => $this->language->get('text_flat_bottom_sidebar'));
		$this->data['themes'][] = array('value' => 'icon-sb-left' , 'title' => $this->language->get('text_flat_left_sidebar'));
		$this->data['themes'][] = array('value' => 'icon-sb-right', 'title' => $this->language->get('text_flat_right_sidebar'));
		$this->data['themes'][] = array('value' => 'semantic', 'title' => $this->language->get('text_flat_semantic'));
		
		
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		$this->template = 'catalog/fnt_product_design_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_product_design')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if ((utf8_strlen($this->request->post['name']) < 1) || (utf8_strlen($this->request->post['name']) > 128)) {
			$this->error['model'] = $this->language->get('error_name');
		}
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_product_design')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/fnt_product_design');
			
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

			$results = $this->model_catalog_fnt_product_design->getProductDesigns($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'product_design_id' => $result['product_design_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}
	
	public function export() {
		$this->load->model('catalog/fnt_product_design');
		if ( !isset($this->request->get['product_design_id']) )
			exit;
		$product_design_id = $this->request->get['product_design_id'];
		$products_design_element = $this->model_catalog_fnt_product_design->getProductDesignImages($product_design_id);
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=fancy_product_'.$product_design_id.'.json');
		$output = '{';
		foreach($products_design_element as $view) {

			$output .= '"'.$view['product_design_element_id'].'": {';
			$output .= '"title": "'.$view['name'].'",';
			$elements = $this->model_catalog_fnt_product_design->getProductDesignElement($view['product_design_element_id']);	
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
		$product_design_id = trim($this->request->post['product_design_id']);
		$elements = isset($this->request->post['elements']) ? $this->request->post['elements'] : false;
		//check if thumbnail is base64 encoded, if yes, create and upload image to library image
		$thumbnail = $this->fntUploadBit($this->request->post['thumbnail_name'], $thumbnail);
		//check if elements are posted
		$this->load->model('catalog/fnt_product_design');
		if($elements !== false) {
			$product_design_element_id = $this->model_catalog_fnt_product_design->addviewDesignByImport($product_design_id,$title,$thumbnail);
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
				$this->model_catalog_fnt_product_design->addProductDesignElement($product_design_element_id,$elements[$i],$i);
				
			}
			$sort_order = $this->model_catalog_fnt_product_design->getTotalProductDesignImages($product_design_id);
			$json['success'] = $this->getViewListItem($product_design_id,$product_design_element_id, $title, $thumbnail,$sort_order - 1 ,$this->request->get['token']);
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
	public function getViewListItem($product_design_id,$product_design_element_id, $title, $thumbnail, $sort_order, $token) {
		$this->load->model('tool/image');
		$this->load->language('catalog/fnt_product_design');
		$image = $this->model_tool_image->resize($thumbnail, 100, 100);
		$no_image = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		$html = '<tr id="image-row' . $sort_order . '"><td class="text-left">';
		$html .= '<img id="thumb' . $sort_order  . '" alt="" src="' . $image . '" class="img-thumbnail img-edit">';
		$html .= '<input type="hidden" id="image' . $sort_order  . '" value="' . $thumbnail . '" name="product_image[' . $sort_order  . '][image]"><br>';
		$html .= '<a onclick="image_upload(\'image' . $sort_order  . '\', \'thumb' . $sort_order  . '\');">' . $this->language->get('text_browse') . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
		$html .= '<a onclick="$(\'#thumb' . $sort_order  . '\').attr(\'src\', \'' . $no_image . '\'); $(\'#image' . $sort_order  . '\').attr(\'value\', \'\');">' . $this->language->get('text_clear') . '</a>';
		$html .= '<input type="hidden" value="' . $product_design_element_id . '" name="product_image[' . $sort_order . '][product_design_element_id]"></td>';
        $html .= '<td class="text-right"><input type="text" class="form-control" placeholder="' . $this->language->get('entry_view_name') . '" value="' . $title . '" name="product_image[' . $sort_order . '][name]"></td>';
       $html .= '<td class="text-left"><input type="text" class="form-control" placeholder="' . $this->language->get('entry_sort_order') . '" value="' . $sort_order . '" name="product_image[' . $sort_order . '][sort_order]"></td>';
	   $html .= '<td class="text-left"> <a title="" data-toggle="tooltip" class="btn btn-primary" href="index.php?route=catalog/fnt_custom_design&product_design_element_id='.$product_design_element_id.'&token=' . $token . '&product_design_id=' . $product_design_id . '" data-original-title="' .$this->language->get('text_edit') . '"><i class="fa fa-edit"></i> ' . $this->language->get('button_edit') . '</a>';
	   $html .= ' <button type="button" onclick="$(\'#image-row' . $sort_order . '\').remove();" class="btn btn-danger"><i class="fa fa-minus-circle"></i> ' . $this->language->get('button_remove') . '</button></td></tr>';
	return $html;
}
}