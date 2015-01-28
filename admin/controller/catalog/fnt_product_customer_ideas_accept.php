<?php 
class ControllerCatalogFntProductCustomerIdeasAccept extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('catalog/fnt_product_customer_ideas_accept');

		$this->document->setTitle($this->language->get('heading_title')); 
		$this->load->model('catalog/fnt_product_design');
		$this->load->model('catalog/fnt_product_customer_ideas_accept');
		$this->getList();
	}
	public function update() {
		$this->load->model('catalog/fnt_product_customer_ideas_accept');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_catalog_fnt_product_customer_ideas_accept->editProductIdeaAccept($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->redirect($this->url->link('catalog/fnt_product_customer_ideas_accept', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/fnt_product_customer_ideas_accept');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/fnt_product_customer_ideas_accept');
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $product_customer_idea_accept_id) {
				$this->model_catalog_fnt_product_customer_ideas_accept->deleteProductIdeaAccept($product_customer_idea_accept_id);
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

			$this->redirect($this->url->link('catalog/fnt_product_customer_ideas_accept', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			'href' => $this->url->link('catalog/fnt_product_customer_ideas_accept', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);
		$this->data['delete'] = $this->url->link('catalog/fnt_product_customer_ideas_accept/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

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

		$product_design_total = $this->model_catalog_fnt_product_customer_ideas_accept->getTotalProductIdeasAccept($filter_data);

		$results = $this->model_catalog_fnt_product_customer_ideas_accept->getProductIdeasAccept($filter_data);
		foreach ($results as $result) {
			$product_design_info = $this->model_catalog_fnt_product_design->getProductDesign($result['product_design_id']);
			if($product_design_info){
				$name_product = $product_design_info['name'];
			} else {
				$name_product = '';
			}
			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}
			$this->data['products'][] = array(
				'product_customer_idea_accept_id' => $result['product_customer_idea_accept_id'],
				'name'        => $result['name'],
				'image'       => $image,
				'name_product'=> $name_product,
				'status'      => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'edit_design' => HTTP_CATALOG . 'index.php?route=product/fnt_category_product_design&product_customer_idea_accept_id='. $result['product_customer_idea_accept_id'],
				'edit'        => $this->url->link('catalog/fnt_custom_design_idea', 'token=' . $this->session->data['token'] . '&product_customer_idea_accept_id=' . $result['product_customer_idea_accept_id'] . $url, 'SSL')
			);
		}
		$this->data['heading_title'] = $this->language->get('heading_title');		

		$this->data['text_enabled'] = $this->language->get('text_enabled');			
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');	
		$this->data['text_confirm'] = $this->language->get('text_confirm');
		
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_image'] = $this->language->get('column_image');		
		$this->data['column_product_design_name'] = $this->language->get('column_product_design_name');		
		$this->data['column_status'] = $this->language->get('column_status');		
		$this->data['column_action'] = $this->language->get('column_action');		
		$this->data['column_image'] = $this->language->get('column_image');		
		$this->data['column_accept'] = $this->language->get('column_accept');		

		$this->data['entry_name'] = $this->language->get('entry_name');		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_product_design'] = $this->language->get('entry_product_design');
		$this->data['entry_filter'] = $this->language->get('entry_filter');
		$this->data['entry_accept'] = $this->language->get('entry_accept');

		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_edit_design'] = $this->language->get('button_edit_design');
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
		$this->data['sort_name'] = $this->url->link('catalog/fnt_product_customer_ideas_accept', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/fnt_product_customer_ideas_accept', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/fnt_product_customer_ideas_accept', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, 'SSL');

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
		$pagination->url = $this->url->link('catalog/fnt_product_customer_ideas_accept', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_name'] = $filter_name;
		$this->data['filter_product_design'] = $filter_product_design;
		$this->data['filter_status'] = $filter_status;
		$this->data['sort'] = $sort;
		$this->data['order'] = $order;
		$this->template = 'catalog/fnt_product_customer_ideas_accept_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_product_customer_ideas_accept')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/fnt_product_customer_ideas');
			
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

			$results = $this->model_catalog_fnt_product_customer_ideas->getProductideas($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'product_customer_idea_id' => $result['product_customer_idea_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}
}