<?php  
class ControllerFancyDesignProductstage extends Controller {
	public function index() {
		$this->language->load('fancy_design/productstage');
		//labels
		$this->data['add_image_tooltip'] = $this->language->get('add_image_tooltip');
		$this->data['add_text_tooltip'] = $this->language->get('add_text_tooltip');
		$this->data['zoom_in_tooltip'] = $this->language->get('zoom_in_tooltip');
		$this->data['zoom_out_tooltip'] = $this->language->get('zoom_out_tooltip');
		$this->data['zoom_reset_tooltip'] = $this->language->get('zoom_reset_tooltip');
		$this->data['download_image_tooltip'] = $this->language->get('download_image_tooltip');
		$this->data['print_tooltip'] = $this->language->get('print_tooltip');
		$this->data['pdf_tooltip'] = $this->language->get('pdf_tooltip');
		$this->data['save_product_tooltip'] = $this->language->get('save_product_tooltip');
		$this->data['saved_products_tooltip'] = $this->language->get('saved_products_tooltip');
		$this->data['reset_tooltip'] = $this->language->get('reset_tooltip');
		
		$this->data['text_add_image'] = $this->language->get('text_add_image');
		$this->data['text_add_text'] = $this->language->get('text_add_text');
		$this->data['text_zoom_in'] = $this->language->get('text_zoom_in');
		$this->data['text_zoom_out'] = $this->language->get('text_zoom_out');
		$this->data['text_zoom_reset'] = $this->language->get('text_zoom_reset');
		$this->data['text_download_image'] = $this->language->get('text_download_image');
		$this->data['text_print'] = $this->language->get('text_print');
		$this->data['text_pdf'] = $this->language->get('text_pdf');
		$this->data['text_save_product'] = $this->language->get('text_save_product');
		$this->data['text_saved_products'] = $this->language->get('text_saved_products');
		$this->data['text_reset'] = $this->language->get('text_reset');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/fancy_design/productstage.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/fancy_design/productstage.tpl';
		} else {
			$this->template = 'default/template/fancy_design/productstage.tpl';
		}		
		$this->response->setOutput($this->render());
	}
}
?>
