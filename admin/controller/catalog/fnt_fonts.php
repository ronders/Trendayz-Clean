<?php
class ControllerCatalogFntFonts extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
		$this->load->language('catalog/fnt_fonts');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {			
			$this->model_setting_setting->editSetting('fonts', $this->request->post);		
			$this->saveWoffFontsCss();
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('catalog/fnt_fonts', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_form'] =  $this->language->get('text_form');
		$this->data['entry_fonts'] = $this->language->get('entry_fonts');
		$this->data['entry_fonts_google'] = $this->language->get('entry_fonts_google');
		$this->data['entry_fonts_directory'] = $this->language->get('entry_fonts_directory');
		$this->data['help_fonts'] = $this->language->get('help_fonts');
		$this->data['help_google_fonts'] = $this->language->get('help_google_fonts');
		$this->data['help_directory_fonts'] = $this->language->get('help_directory_fonts');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
	
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
 		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} 
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text' => $this->language->get('text_home'),
			'separator' => false,
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text' => $this->language->get('text_module'),
			'separator' => ':',
			'href' => $this->url->link('catalog/fnt_fonts', 'token=' . $this->session->data['token'], 'SSL')
   		);
		
		$this->data['action'] = $this->url->link('catalog/fnt_fonts', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['token'] = $this->session->data['token'];
		$this->data['fonts'] = $this->config->get('fonts');
		if($this->config->get('fonts_default')) {	
			$this->data['fonts_default'] = $this->config->get('fonts_default');
		} else {
			$this->data['fonts_default'] = 'Arial,Helvetica,Times New Roman,Verdana,Geneva';
		}
		if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') .'/stylesheet/fancy_design/fonts/webFontNames.txt')){
			$url = DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') .'/stylesheet/fancy_design/fonts/webFontNames.txt';
		} else {
			$url = DIR_CATALOG . 'view/theme/default/stylesheet/fancy_design/fonts/webFontNames.txt';
		}
		$content = file_get_contents($url);
		if($content){
			$this->data['content'] = explode(",", $content);
		} else {
			$this->data['content'] = array();
		}
		//Get woff fonts;
		$this->data['woff_font'] = $this->getWoffFonts();
		$this->data['woff_font_selected'] = array();
		$this->data['title_woff_font_selected'] = array();
		$woff_font_selected = $this->config->get('fonts_woff');
		if($woff_font_selected){
			foreach($woff_font_selected as $value){
				$this->data['woff_font_selected'][preg_replace("/\\.[^.\\s]{3,4}$/", "", $value)] = $value;
				$this->data['title_woff_font_selected'][] = preg_replace("/\\.[^.\\s]{3,4}$/", "", $value);
			}
		}
		
		$this->template = 'catalog/fnt_fonts.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_fonts')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}		
		return !$this->error;
	}
	protected function getWoffFonts() {
		//load woff fonts from fonts directory
		if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') .'/stylesheet/fancy_design/fonts')){
			$files = scandir(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') .'/stylesheet/fancy_design/fonts');
		} else {
			$files = scandir(DIR_CATALOG . 'view/theme/default/stylesheet/fancy_design/fonts');
		}	
		$woff_files = array();
		foreach($files as $file) {
			if(preg_match("/.woff/", $file)) {
				$woff_files[$file] = preg_replace("/\\.[^.\\s]{3,4}$/", "", $file);
			}
		}

		return $woff_files;
	}
	protected function saveWoffFontsCss() {
		if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') .'/stylesheet/fancy_design/jquery.fancyProductDesigner-fonts.css')){
			$fonts_css = DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') .'/stylesheet/fancy_design/jquery.fancyProductDesigner-fonts.css';
		} else {
			$fonts_css = DIR_CATALOG . 'view/theme/default/stylesheet/fancy_design/jquery.fancyProductDesigner-fonts.css';
		}	
		chmod($fonts_css, 0775);
		$handle = @fopen($fonts_css, 'w') or print('Cannot open file:  '.$fonts_css);
		if(file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') .'/stylesheet/fancy_design/fonts')){
			$files = scandir(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') .'/stylesheet/fancy_design/fonts');
		} else {
			$files = scandir(DIR_CATALOG . 'view/theme/default/stylesheet/fancy_design/fonts');
		}	
		$data = '';
		if(is_array($files)) {
			foreach($files as $file) {
				if(preg_match("/.woff/", $file)) {
					$data .= '@font-face {'."\n";
					$data .= '  font-family: "'.preg_replace("/\\.[^.\\s]{3,4}$/", "", $file).'";'."\n";
					$data .= '  src: local("#"), url(fonts/'.$file.') format("woff");'."\n";
					$data .= '  font-weight: normal;'."\n";
					$data .= '  font-style: normal;'."\n";
					$data .= '}'."\n\n\n";
				}
			}
		}

		fwrite($handle, $data);
		fclose($handle);

	}
}
