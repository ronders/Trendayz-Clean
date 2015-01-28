<?php  
class ControllerFancyDesignProductstageSemantic extends Controller {
	public function index() {
		$this->language->load('fancy_design/productstage');
		$this->data['add_image_tooltip'] = $this->language->get('add_image_tooltip');
		$this->data['add_text_tooltip'] = $this->language->get('add_text_tooltip');
		$this->data['zoom_in_tooltip'] = $this->language->get('zoom_in_tooltip');
		$this->data['zoom_out_tooltip'] = $this->language->get('zoom_out_tooltip');
		$this->data['zoom_reset_tooltip'] = $this->language->get('zoom_reset_tooltip');
		$this->data['pdf_tooltip'] = $this->language->get('pdf_tooltip');
		$this->data['download_image_tooltip'] = $this->language->get('download_image_tooltip');
		$this->data['print_tooltip'] = $this->language->get('print_tooltip');
		$this->data['save_product_tooltip'] = $this->language->get('save_product_tooltip');
		$this->data['saved_products_tooltip'] = $this->language->get('saved_products_tooltip');
		$this->data['reset_tooltip'] = $this->language->get('reset_tooltip');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/fancy_design/productstage-semantic.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/fancy_design/productstage-semantic.tpl';
		} else {
			$this->template = 'default/template/fancy_design/productstage-semantic.tpl';
		}		
		$this->response->setOutput($this->render());
	}
}
?>
