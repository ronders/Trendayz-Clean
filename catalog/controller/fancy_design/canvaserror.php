
<?php  
class ControllerFancyDesignCanvaserror extends Controller {
	public function index() {
		$this->language->load('fancy_desing/canvaserror');
		$this->data['text_content'] = $this->language->get('text_content');
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/fancy_design/canvaserror.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/fancy_design/canvaserror.tpl';
		} else {
			$this->template = 'default/template/fancy_design/canvaserror.tpl';
		}		
		$this->response->setOutput($this->render());
	}
}
?>
