<?php
class ControllerCatalogFntCustomDesignIdea extends Controller
{
    private $error = array();

    public function index()
    {
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
		
        $this->load->language('catalog/fnt_custom_design_idea');
        $this->document->setTitle($this->language->get('heading_title'));
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_form'] = !isset($this->request->get['product_customer_idea_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $this->load->model('catalog/fnt_product_design');
		$this->load->model('catalog/fnt_product_customer_ideas');
		$this->load->model('catalog/fnt_product_customer_ideas_accept');
		$this->load->model('tool/image');
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');	
		$this->data['button_save'] = $this->language->get('button_save');	
		$this->data['button_cancel'] = $this->language->get('button_cancel');	
		$this->data['action'] = $this->url->link('catalog/fnt_custom_design_idea/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('catalog/fnt_product_customer_ideas', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'separator' => false,
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'separator' => ':',
			'href' => $this->url->link('catalog/fnt_product_customer_ideas', 'token=' . $this->session->data['token'], 'SSL')
		);
		$this->data['token'] = $this->session->data['token'];
		if(isset($this->request->get['product_customer_idea_accept_id'])){
			$this->data['action'] = $this->url->link('catalog/fnt_product_customer_ideas_accept/update', 'token=' . $this->session->data['token'], 'SSL');
			$this->data['product_customer_idea_accept_id'] = $this->request->get['product_customer_idea_accept_id'];
			$customer_idea_info = $this->model_catalog_fnt_product_customer_ideas_accept->getProductIdeaAccept($this->request->get['product_customer_idea_accept_id']);	
		} else {
			$this->data['action'] = $this->url->link('catalog/fnt_custom_design_idea/insert', 'token=' . $this->session->data['token'], 'SSL');
			$customer_idea_info = $this->model_catalog_fnt_product_customer_ideas->getProductIdea($this->request->get['product_customer_idea_id']);
		}
		if($customer_idea_info){
			$product_design_info = $this->model_catalog_fnt_product_design->getProductDesign($customer_idea_info['product_design_id']);
			$this->data['product_design_id'] = $customer_idea_info['product_design_id'];
			$this->data['product_customer_idea_id'] = $customer_idea_info['product_customer_idea_id'];
			$this->data['name'] = $customer_idea_info['name'];
			$this->data['customer_id'] = $customer_idea_info['customer_id'];
			$this->data['status'] = $customer_idea_info['status'];
			if(isset($customer_idea_info['image'])){
				$this->data['image'] = $customer_idea_info['image'];
			} else {
				$this->data['image'] = '';
			}
			$this->load->model('tool/image');
			if(isset($customer_idea_info['image']) && file_exists(DIR_IMAGE . $customer_idea_info['image'])) {
				$this->data['thumb'] = $this->model_tool_image->resize($customer_idea_info['image'], 100, 100);
			} else {
				$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
			}
			
		} else {
			$this->data['product_design_id'] = 0;
		}
        $this->template = 'catalog/fnt_custom_design_idea.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
    }

    public function insert(){
		if ($this->request->server['REQUEST_METHOD'] == 'POST'){
			$this->load->model('catalog/fnt_product_customer_ideas_accept');
			$this->model_catalog_fnt_product_customer_ideas_accept->addIdeaAccept($this->request->post);
			$this->redirect($this->url->link('catalog/fnt_product_customer_ideas', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}
}