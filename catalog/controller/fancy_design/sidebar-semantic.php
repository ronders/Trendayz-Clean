<?php
class ControllerFancyDesignSidebarSemantic extends Controller {
	public function index() { 
	
		$this->language->load('fancy_design/sidebar_semantic');
		$this->data['products_menu'] = $this->language->get('products_menu');
		$this->data['designs_menu'] = $this->language->get('designs_menu');
		$this->data['edit_elements_menu'] = $this->language->get('edit_elements_menu');
		$this->data['fb_photos_menu'] = $this->language->get('fb_photos_menu');
		$this->data['insta_photos_menu'] = $this->language->get('insta_photos_menu');
		$this->data['edit_elements_headline'] = $this->language->get('edit_elements_headline');
		$this->data['edit_elements_dropdown_none'] = $this->language->get('edit_elements_dropdown_none');
		$this->data['section_filling'] = $this->language->get('section_filling');
		$this->data['section_fonts_styles'] = $this->language->get('section_fonts_styles');
		$this->data['section_curved_text'] = $this->language->get('section_curved_text');
		$this->data['section_helpers'] = $this->language->get('section_helpers');
		$this->data['customize_text_align_left'] = $this->language->get('customize_text_align_left');
		$this->data['customize_text_align_center'] = $this->language->get('customize_text_align_center');
		$this->data['customize_text_align_right'] = $this->language->get('customize_text_align_right');
		$this->data['customize_text_bold'] = $this->language->get('customize_text_bold');
		$this->data['customize_text_italic'] = $this->language->get('customize_text_italic');
		$this->data['curved_text_info'] = $this->language->get('curved_text_info');
		$this->data['curved_text_spacing'] = $this->language->get('curved_text_spacing');
		$this->data['curved_text_radius'] = $this->language->get('curved_text_radius');
		$this->data['curved_text_reverse'] = $this->language->get('curved_text_reverse');
		$this->data['curved_text_toggle'] = $this->language->get('curved_text_toggle');
		$this->data['customize_center_h'] = $this->language->get('customize_center_h');
		$this->data['customize_center_c'] = $this->language->get('customize_center_c');
		$this->data['customize_center_move_down'] = $this->language->get('customize_center_move_down');
		$this->data['customize_center_move_up'] = $this->language->get('customize_center_move_up');
		$this->data['customize_reset'] = $this->language->get('customize_reset');
		$this->data['customize_center_trash'] = $this->language->get('customize_center_trash');
		$this->data['fb_photos_headline'] = $this->language->get('fb_photos_headline');
		$this->data['fb_select_friend'] = $this->language->get('fb_select_friend');
		$this->data['fb_select_album'] = $this->language->get('fb_select_album');
		$this->data['insta_photos_headline'] = $this->language->get('insta_photos_headline');
		$this->data['insta_feed_button'] = $this->language->get('insta_feed_button');
		$this->data['insta_recent_images_button'] = $this->language->get('insta_recent_images_button');
		$this->data['insta_load_next'] = $this->language->get('insta_load_next');
		$this->data['text_select_product'] = $this->language->get('text_select_product');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/fancy_design/sidebar-semantic.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/fancy_design/sidebar-semantic.tpl';
		} else {
			$this->template = 'default/template/fancy_design/sidebar-semantic.tpl';
		}			
		$this->response->setOutput($this->render());
		
	}
}	
?>