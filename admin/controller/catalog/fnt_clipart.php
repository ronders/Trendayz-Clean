<?php 
class ControllerCatalogfntClipart extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('catalog/fnt_clipart');

		$this->document->setTitle($this->language->get('heading_title')); 

		$this->load->model('catalog/fnt_clipart');

		$this->getList();
	}

	public function insert() {
		$this->load->language('catalog/fnt_clipart');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_clipart');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_fnt_clipart->addClipart($this->request->post);

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

			$this->redirect($this->url->link('catalog/fnt_clipart', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('catalog/fnt_clipart');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_clipart');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_fnt_clipart->editClipart($this->request->get['clipart_id'], $this->request->post);

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

			$this->redirect($this->url->link('catalog/fnt_clipart', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/fnt_clipart');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/fnt_clipart');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $clipart_id) {
				$this->model_catalog_fnt_clipart->deleteClipart($clipart_id);
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

			$this->redirect($this->url->link('catalog/fnt_clipart', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('catalog/fnt_clipart', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$this->data['insert'] = $this->url->link('catalog/fnt_clipart/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['copy'] = $this->url->link('catalog/fnt_clipart/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('catalog/fnt_clipart/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['cliparts'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name, 
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit')
		);
	
		$this->load->model('tool/image');

		$clipart_total = $this->model_catalog_fnt_clipart->getTotalCliparts($filter_data);
		$results = $this->model_catalog_fnt_clipart->getCliparts($filter_data);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = '';
			}
			$temp_parameter = unserialize($result['parameter']);
			$this->data['cliparts'][] = array(
				'clipart_id' => $result['clipart_id'],
				'image'      => $image,
				'name'       => $result['name'],
				'price'      => $temp_parameter['price'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'edit'       => $this->url->link('catalog/fnt_clipart/update', 'token=' . $this->session->data['token'] . '&clipart_id=' . $result['clipart_id'] . $url, 'SSL')
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');		

		$this->data['text_enabled'] = $this->language->get('text_enabled');			
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');	
		$this->data['text_confirm'] = $this->language->get('text_confirm');
		$this->data['column_image'] = $this->language->get('column_image');		
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_price'] = $this->language->get('column_price');			
		$this->data['column_status'] = $this->language->get('column_status');		
		$this->data['column_action'] = $this->language->get('column_action');		

		$this->data['entry_name'] = $this->language->get('entry_name');				
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_price'] = $this->language->get('entry_price');

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

		$this->data['sort_name'] = $this->url->link('catalog/fnt_clipart', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/fnt_clipart', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/fnt_clipart', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

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
		$pagination->total = $clipart_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->url = $this->url->link('catalog/fnt_clipart', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_name'] = $filter_name;
		$this->data['filter_status'] = $filter_status;
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->template = 'catalog/fnt_clipart_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addScript('view/javascript/jquery/jscolor/jscolor.js');	
		$this->document->addScript('view/javascript/common-fancy.js');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_form'] = !isset($this->request->get['clipart_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$this->data['clipart'] = $this->language->get('clipart');
		$this->data['setting'] = $this->language->get('setting');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['help_category'] = $this->language->get('help_category');
		$this->data['text_check'] = $this->language->get('text_check');
		//entry
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
		$this->data['entry_designs_parameter_scale'] = $this->language->get('entry_designs_parameter_scale');
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
		//button
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
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
			'href' => $this->url->link('catalog/fnt_clipart', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['clipart_id'])) {
			$this->data['action'] = $this->url->link('catalog/fnt_clipart/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/fnt_clipart/update', 'token=' . $this->session->data['token'] . '&clipart_id=' . $this->request->get['clipart_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('catalog/fnt_clipart', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['clipart_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$clipart_info = $this->model_catalog_fnt_clipart->getClipart($this->request->get['clipart_id']);
		}		
		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->post['name'])) {
			$this->data['name'] = $this->request->post['name'];
		} elseif (!empty($clipart_info)) {
			$this->data['name'] = $clipart_info['name'];
		} else {
			$this->data['name'] = '';
		}		

		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($clipart_info)) {
			$this->data['sort_order'] = $clipart_info['sort_order'];
		} else {
			$this->data['sort_order'] = 1;
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($clipart_info)) {
			$this->data['status'] = $clipart_info['status'];
		} else {
			$this->data['status'] = 1;
		}
	
		// Categories
		$this->load->model('catalog/fnt_category_clipart');

		if (isset($this->request->post['clipart_category'])) {
			$categories = $this->request->post['clipart_category'];
		} elseif (isset($this->request->get['clipart_id'])) {		
			$categories = $this->model_catalog_fnt_clipart->getClipartCategories($this->request->get['clipart_id']);
		} else {
			$categories = array();
		}

		$this->data['clipart_categories'] = array();		
		foreach ($categories as $category_clipart_id) {
			$category_info = $this->model_catalog_fnt_category_clipart->getCategoryClipart($category_clipart_id);
			$category_info_desc = $this->model_catalog_fnt_category_clipart->getCategoryClipartDescriptions($category_clipart_id);
			if($category_info_desc){
				if($category_info_desc[(int)$this->config->get('config_language_id')]){
					$name = $category_info_desc[(int)$this->config->get('config_language_id')];
				} else {
					$name = $category_info_desc[0];
				}
			}	
			if ($category_info) {
				$this->data['clipart_categories'][] = array(
					'category_clipart_id' => $category_info['category_clipart_id'],
					'name'                => $name
				);
			}
		}

		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($clipart_info)) {
			$this->data['image'] = $clipart_info['image'];
		} else {
			$this->data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($clipart_info) && is_file(DIR_IMAGE . $clipart_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($clipart_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}
		
		if (isset($this->request->post['parameter'])) {
			$this->data['parameter'] = $this->request->post['parameter'];
		} elseif (!empty($clipart_info)) {
			$this->data['parameter'] = unserialize($clipart_info['parameter']);
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
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		$this->template = 'catalog/fnt_clipart_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_clipart')) {
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
		if (!$this->user->hasPermission('modify', 'catalog/fnt_clipart')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/fnt_clipart');
			
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

			$results = $this->model_catalog_fnt_clipart->getCliparts($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'clipart_id' => $result['clipart_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}
}