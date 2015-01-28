<?php
class ControllerFancyDesignEditorbox extends Controller
{
    private $error = array();

    public function index()
    {
		$this->load->language('fancy_design/fnt_template_fancy');	
		$this->data['headline'] = $this->language->get('headline');
		$this->data['element_label'] = $this->language->get('element_label');
		$this->data['position_label'] = $this->language->get('position_label');
		$this->data['scale_label'] = $this->language->get('scale_label');
		$this->data['dimensions_label'] = $this->language->get('dimensions_label');
		$this->data['angle_label'] = $this->language->get('angle_label');
		$this->data['colors_label'] = $this->language->get('colors_label');
		$this->template = 'fancy_design/editorbox.tpl';       
		$this->response->setOutput($this->render());
}}
?>