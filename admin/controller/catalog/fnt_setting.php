<?php
class ControllerCatalogFntSetting extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
		//$this->load->language('catalog/fnt_setting');
		$this->language->load('catalog/fnt_setting');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {			
			$this->model_setting_setting->editSetting('config_design', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('catalog/fnt_setting', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_form'] = $this->language->get('text_form');
		$this->data['text_design_upload_image'] = $this->language->get('text_design_upload_image');
		$this->data['text_cumstom'] = $this->language->get('text_cumstom');
		$this->data['text_label_patternable'] = $this->language->get('text_label_patternable');		
		$this->data['entry_stage_width'] = $this->language->get('entry_stage_width');			
		$this->data['entry_stage_height'] = $this->language->get('entry_stage_height');			
		$this->data['entry_stage_max_width'] = $this->language->get('entry_stage_max_width');			
		$this->data['entry_default_text_size'] = $this->language->get('entry_default_text_size');			
		$this->data['help_default_text'] = $this->language->get('help_default_text');			
		$this->data['entry_allow_product_saving'] = $this->language->get('entry_allow_product_saving');			
		$this->data['entry_pdf_button'] = $this->language->get('entry_pdf_button');			
		$this->data['entry_center_in_bounding_box'] = $this->language->get('entry_center_in_bounding_box');			
		$this->data['entry_upload_designs'] = $this->language->get('entry_upload_designs');			
		$this->data['entry_upload_designs_logged_in'] = $this->language->get('entry_upload_designs_logged_in');			
		$this->data['entry_zoom'] = $this->language->get('entry_zoom');			
		$this->data['entry_zoom_min'] = $this->language->get('entry_zoom_min');			
		$this->data['entry_zoom_max'] = $this->language->get('entry_zoom_max');			
		$this->data['entry_instagram_client_id'] = $this->language->get('entry_instagram_client_id');			
		$this->data['entry_instagram_redirect_uri'] = $this->language->get('entry_instagram_redirect_uri');			
		$this->data['entry_designs_autoselect'] = $this->language->get('entry_designs_autoselect');			
		$this->data['entry_designs_replace'] = $this->language->get('entry_designs_replace');			
		$this->data['entry_designs_clipping'] = $this->language->get('entry_designs_clipping');			
		$this->data['entry_designs_bounding_box'] = $this->language->get('entry_designs_bounding_box');			
		$this->data['entry_bounding_box_target'] = $this->language->get('entry_bounding_box_target');			
		$this->data['entry_text_curved'] = $this->language->get('entry_text_curved');						
		$this->data['entry_text_characters'] = $this->language->get('entry_text_characters');						
		$this->data['entry_config_text_default'] = $this->language->get('entry_config_text_default');						
		
		$this->data['entry_view_all_design'] = $this->language->get('entry_view_all_design');						
		$this->data['entry_show_popup_view'] = $this->language->get('entry_show_popup_view');						
		$this->data['entry_view_selection_float'] = $this->language->get('entry_view_selection_float');						
		$this->data['entry_download_image'] = $this->language->get('entry_download_image');						
		$this->data['entry_print_button'] = $this->language->get('entry_print_button');						
		$this->data['entry_upload_text'] = $this->language->get('entry_upload_text');						
		$this->data['entry_reset_table'] = $this->language->get('entry_reset_table');						
		$this->data['entry_fonts_dropdown'] = $this->language->get('entry_fonts_dropdown');						
		$this->data['entry_selected_color'] = $this->language->get('entry_selected_color');						
		$this->data['entry_bounding_color'] = $this->language->get('entry_bounding_color');						
		$this->data['entry_out_boundary_color'] = $this->language->get('entry_out_boundary_color');						
		$this->data['entry_designs_parameter_remove'] = $this->language->get('entry_designs_parameter_remove');												
		$this->data['entry_sidebar_content_width']=$this->language->get('entry_sidebar_content_width');						
		$this->data['entry_facebook_app_id']=$this->language->get('entry_facebook_app_id');
		$this->data['entry_designs_parameter_x']=$this->language->get('entry_designs_parameter_x');
		$this->data['entry_designs_parameter_y']=$this->language->get('entry_designs_parameter_y');
		$this->data['entry_designs_parameter_z']=$this->language->get('entry_designs_parameter_z');
		$this->data['entry_designs_parameter_colors']=$this->language->get('entry_designs_parameter_colors');
		$this->data['entry_designs_parameter_price']=$this->language->get('entry_designs_parameter_price');		
		$this->data['entry_designs_parameter_auto_center']=$this->language->get('entry_designs_parameter_auto_center');		
		$this->data['entry_designs_parameter_draggable']=$this->language->get('entry_designs_parameter_draggable');		
		$this->data['entry_designs_parameter_rotatable']=$this->language->get('entry_designs_parameter_rotatable');		
		$this->data['entry_designs_parameter_resizable']=$this->language->get('entry_designs_parameter_resizable');		
		$this->data['entry_designs_parameter_zchangeable']=$this->language->get('entry_designs_parameter_zchangeable');		
		$this->data['entry_bounding_box_x']=$this->language->get('entry_bounding_box_x');		
		$this->data['entry_bounding_box_y']=$this->language->get('entry_bounding_box_y');		
		$this->data['entry_bounding_box_width']=$this->language->get('entry_bounding_box_width');		
		$this->data['entry_bounding_box_height']=$this->language->get('entry_bounding_box_height');		
		$this->data['entry_min_width']=$this->language->get('entry_min_width');		
		$this->data['entry_min_height']=$this->language->get('entry_min_height');		
		$this->data['entry_max_width']=$this->language->get('entry_max_width');		
		$this->data['entry_max_height']=$this->language->get('entry_max_height');		
		$this->data['entry_resize_width']=$this->language->get('entry_resize_width');		
		$this->data['entry_resize_height']=$this->language->get('entry_resize_height');		
		$this->data['entry_text_x_position']=$this->language->get('entry_text_x_position');		
		$this->data['entry_text_patternable']=$this->language->get('entry_text_patternable');		
		$this->data['entry_text_bounding_x_position']=$this->language->get('entry_text_bounding_x_position');
		$this->data['entry_config_color_sidebar'] = $this->language->get('entry_config_color_sidebar');						
		$this->data['entry_config_color_icon'] = $this->language->get('entry_config_color_icon');	
		
		$this->data['help_sidebar_nav_width']=$this->language->get('help_sidebar_nav_width');
		$this->data['help_sidebar_content_width']=$this->language->get('help_sidebar_content_width');
		$this->data['help_stage_width']=$this->language->get('help_stage_width');
		$this->data['help_stage_height']=$this->language->get('help_stage_height');		
		$this->data['help_stage_max_width']=$this->language->get('help_stage_max_width');		
		$this->data['help_product'] = $this->language->get('help_product');								
		$this->data['help_zoom'] = $this->language->get('help_zoom');								
		$this->data['help_zoom_min'] = $this->language->get('help_zoom_min');								
		$this->data['help_zoom_max'] = $this->language->get('help_zoom_max');								
		$this->data['help_facebook_app_id'] = $this->language->get('help_facebook_app_id');
		$this->data['help_instagram_client_id'] = $this->language->get('help_instagram_client_id');
		$this->data['help_instagram_redirect_uri'] = $this->language->get('help_instagram_redirect_uri');		
		$this->data['help_designs_parameter_z'] = $this->language->get('help_designs_parameter_z');
		$this->data['help_bounding_box_target'] = $this->language->get('help_bounding_box_target');
		$this->data['help_designs_parameter_colors'] = $this->language->get('help_designs_parameter_colors');
		$this->data['help_designs_parameter_price'] = $this->language->get('help_designs_parameter_price');				
		$this->data['help_designs_parameter_zchangeable'] = $this->language->get('help_designs_parameter_zchangeable');
		$this->data['help_bounding_box_x'] = $this->language->get('help_bounding_box_x');					
		$this->data['help_min_width'] = $this->language->get('help_min_width');
		$this->data['help_min_height'] = $this->language->get('help_min_height');
		$this->data['help_max_width'] = $this->language->get('help_max_width');
		$this->data['help_max_height'] = $this->language->get('help_max_height');
		$this->data['help_resize_width'] = $this->language->get('help_resize_width');
		$this->data['help_resize_height'] = $this->language->get('help_resize_height');
		$this->data['help_text_patternable'] = $this->language->get('help_text_patternable');		
		$this->data['help_text_curved'] = $this->language->get('help_text_curved');		
		$this->data['help_default_text_size'] = $this->language->get('help_default_text_size');		
		$this->data['help_text_characters'] = $this->language->get('help_text_characters');		
		
		$this->data['description_designs_parameter_auto_center'] =$this->language->get('description_designs_parameter_auto_center');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');		
		$this->data['text_save_edit'] = $this->language->get('text_save_edit');		
		$this->data['text_design_image'] = $this->language->get('text_design_image');		
		$this->data['text_general'] = $this->language->get('text_general');		
		$this->data['text_custom'] = $this->language->get('text_custom');		
		$this->data['text_title_general'] = $this->language->get('text_title_general');	
		
		$this->data['entry_theme'] = $this->language->get('entry_theme');	
		$this->data['entry_view_tooltip'] = $this->language->get('entry_view_tooltip');	
		$this->data['entry_responsive'] = $this->language->get('entry_responsive');	
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
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
			'href' => $this->url->link('catalog/fnt_setting', 'token=' . $this->session->data['token'], 'SSL')
   		);
		$this->data['action'] = $this->url->link('catalog/fnt_setting', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['edit'] = $this->url->link('catalog/fnt_setting', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['token'] = $this->session->data['token'];
		
		$this->data['themes'][] = array('value'=>'icon-sb-top','title' => $this->language->get('text_flat_top_sidebar'));
		$this->data['themes'][] = array('value'=>'icon-sb-bottom','title' => $this->language->get('text_flat_bottom_sidebar'));
		$this->data['themes'][] = array('value' => 'icon-sb-left' , 'title' => $this->language->get('text_flat_left_sidebar'));
		$this->data['themes'][] = array('value' => 'icon-sb-right', 'title' => $this->language->get('text_flat_right_sidebar'));
		$this->data['themes'][] = array('value' => 'semantic', 'title' => $this->language->get('text_flat_semantic'));
		
		if(isset($this->request->post['config_theme'])){
			$this->data['config_theme']=$this->request->post['config_theme'];		
		}elseif($this->config->get('config_theme')){
			$this->data['config_theme']=$this->config->get('config_theme');			
		}else{
			$this->data['config_theme']='';
		}
		if(isset($this->request->post['config_view_tooltip'])){
			$this->data['config_view_tooltip']=$this->request->post['config_view_tooltip'];		
		}elseif($this->config->get('config_view_tooltip')){
			$this->data['config_view_tooltip']=$this->config->get('config_view_tooltip');			
		}else{
			$this->data['config_view_tooltip'] = 0;
		}
		
		if(isset($this->request->post['config_responsive'])){
			$this->data['config_responsive']=$this->request->post['config_responsive'];		
		}elseif($this->config->get('config_responsive')){
			$this->data['config_responsive']=$this->config->get('config_responsive');			
		}else{
			$this->data['config_responsive'] = 0;
		}
		
		if(isset($this->request->post['config_sidebar_content_width'])){
			$this->data['config_sidebar_content_width']=$this->request->post['config_sidebar_content_width'];		
		}elseif($this->config->get('config_sidebar_content_width')){
			$this->data['config_sidebar_content_width']=$this->config->get('config_sidebar_content_width');			
		}else{
			$this->data['config_sidebar_content_width'] = 0;
		}
		
		if(isset($this->request->post['config_stage_width'])){
			$this->data['config_stage_width']=$this->request->post['config_stage_width'];		
		}elseif($this->config->get('config_stage_width')){
			$this->data['config_stage_width']=$this->config->get('config_stage_width');			
		}else{
			$this->data['config_stage_width'] = 0;
		}
		
		if(isset($this->request->post['config_stage_height'])){
			$this->data['config_stage_height']=$this->request->post['config_stage_height'];		
		}elseif($this->config->get('config_stage_height')){
			$this->data['config_stage_height']=$this->config->get('config_stage_height');			
		}else{
			$this->data['config_stage_height'] = 0;
		}
		
		if(isset($this->request->post['config_stage_max_width'])){
			$this->data['config_stage_max_width']=$this->request->post['config_stage_max_width'];		
		}elseif($this->config->get('config_stage_max_width')){
			$this->data['config_stage_max_width']=$this->config->get('config_stage_max_width');			
		}else{
			$this->data['config_stage_max_width'] = 0;
		}
		
		if(isset($this->request->post['config_default_text_size'])){
			$this->data['config_default_text_size']=$this->request->post['config_default_text_size'];		
		}elseif($this->config->get('config_default_text_size')){
			$this->data['config_default_text_size']=$this->config->get('config_default_text_size');			
		}else{
			$this->data['config_default_text_size'] = 25;
		}
		if(isset($this->request->post['config_text_default'])){
			$this->data['config_text_default']=$this->request->post['config_text_default'];		
		}elseif($this->config->get('config_text_default')){
			$this->data['config_text_default']=$this->config->get('config_text_default');			
		}else{
			$this->data['config_text_default']= 'Double-click to change text';
		}
		
		if(isset($this->request->post['config_allow_product_saving'])){
			$this->data['config_allow_product_saving']=$this->request->post['config_allow_product_saving'];		
		}elseif($this->config->get('config_allow_product_saving')){
			$this->data['config_allow_product_saving']=$this->config->get('config_allow_product_saving');			
		}else{
			$this->data['config_allow_product_saving']='';
		}
		
		if(isset($this->request->post['config_pdf_button'])){
			$this->data['config_pdf_button']=$this->request->post['config_pdf_button'];		
		}elseif($this->config->get('config_pdf_button')){
			$this->data['config_pdf_button']=$this->config->get('config_pdf_button');			
		}else{
			$this->data['config_pdf_button']='';
		}
		
		if(isset($this->request->post['config_view_all_design'])){
			$this->data['config_view_all_design']=$this->request->post['config_view_all_design'];		
		}elseif($this->config->get('config_view_all_design')){
			$this->data['config_view_all_design']=$this->config->get('config_view_all_design');			
		}else{
			$this->data['config_view_all_design']='';
		}
		
		if(isset($this->request->post['config_show_popup_view'])){
			$this->data['config_show_popup_view']=$this->request->post['config_show_popup_view'];		
		}elseif($this->config->get('config_show_popup_view')){
			$this->data['config_show_popup_view']=$this->config->get('config_show_popup_view');			
		}else{
			$this->data['config_show_popup_view']='';
		}
		
		if(isset($this->request->post['config_view_selection_float'])){
			$this->data['config_view_selection_float']=$this->request->post['config_view_selection_float'];		
		}elseif($this->config->get('config_view_selection_float')){
			$this->data['config_view_selection_float']=$this->config->get('config_view_selection_float');			
		}else{
			$this->data['config_view_selection_float']='';
		}
		if(isset($this->request->post['config_download_image'])){
			$this->data['config_download_image']=$this->request->post['config_download_image'];		
		}elseif($this->config->get('config_download_image')){
			$this->data['config_download_image']=$this->config->get('config_download_image');			
		}else{
			$this->data['config_download_image']='';
		}
		if(isset($this->request->post['config_print_button'])){
			$this->data['config_print_button']=$this->request->post['config_print_button'];		
		}elseif($this->config->get('config_print_button')){
			$this->data['config_print_button']=$this->config->get('config_print_button');			
		}else{
			$this->data['config_print_button']='';
		}
		if(isset($this->request->post['config_upload_text'])){
			$this->data['config_upload_text']=$this->request->post['config_upload_text'];		
		}elseif($this->config->get('config_upload_text')){
			$this->data['config_upload_text']=$this->config->get('config_upload_text');			
		}else{
			$this->data['config_upload_text']='';
		}
		if(isset($this->request->post['config_reset_table'])){
			$this->data['config_reset_table']=$this->request->post['config_reset_table'];		
		}elseif($this->config->get('config_reset_table')){
			$this->data['config_reset_table']=$this->config->get('config_reset_table');			
		}else{
			$this->data['config_reset_table']='';
		}
		if(isset($this->request->post['config_font_dropdown'])){
			$this->data['config_font_dropdown']=$this->request->post['config_font_dropdown'];		
		}elseif($this->config->get('config_font_dropdown')){
			$this->data['config_font_dropdown']=$this->config->get('config_font_dropdown');			
		}else{
			$this->data['config_font_dropdown']='';
		}
		if(isset($this->request->post['config_selected_color'])){
			$this->data['config_selected_color']=$this->request->post['config_selected_color'];		
		}elseif($this->config->get('config_selected_color')){
			$this->data['config_selected_color']=$this->config->get('config_selected_color');			
		}else{
			$this->data['config_selected_color']='';
		}
		if(isset($this->request->post['config_bounding_color'])){
			$this->data['config_bounding_color']=$this->request->post['config_bounding_color'];		
		}elseif($this->config->get('config_bounding_color')){
			$this->data['config_bounding_color']=$this->config->get('config_bounding_color');			
		}else{
			$this->data['config_bounding_color']='';
		}
		if(isset($this->request->post['config_out_boundary_color'])){
			$this->data['config_out_boundary_color']=$this->request->post['config_out_boundary_color'];		
		}elseif($this->config->get('config_out_boundary_color')){
			$this->data['config_out_boundary_color']=$this->config->get('config_out_boundary_color');			
		}else{
			$this->data['config_out_boundary_color']='';
		}
		if(isset($this->request->post['config_color_sidebar'])){
			$this->data['config_color_sidebar']=$this->request->post['config_color_sidebar'];		
		}elseif($this->config->get('config_color_sidebar')){
			$this->data['config_color_sidebar']=$this->config->get('config_color_sidebar');			
		}else{
			$this->data['config_color_sidebar']='';
		}
		if(isset($this->request->post['config_color_icon'])){
			$this->data['config_color_icon']=$this->request->post['config_color_icon'];		
		}elseif($this->config->get('config_color_icon')){
			$this->data['config_color_icon']=$this->config->get('config_color_icon');			
		}else{
			$this->data['config_color_icon']='';
		}
		if(isset($this->request->post['config_designs_parameter_remove'])){
			$this->data['config_designs_parameter_remove']=$this->request->post['config_designs_parameter_remove'];		
		}elseif($this->config->get('config_designs_parameter_remove')){
			$this->data['config_designs_parameter_remove']=$this->config->get('config_designs_parameter_remove');			
		}else{
			$this->data['config_designs_parameter_remove']='';
		}
		if(isset($this->request->post['config_text_remove'])){
			$this->data['config_text_remove']=$this->request->post['config_text_remove'];		
		}elseif($this->config->get('config_text_remove')){
			$this->data['config_text_remove']=$this->config->get('config_text_remove');			
		}else{
			$this->data['config_text_remove']='';
		}
		if(isset($this->request->post['config_center_in_bounding_box'])){
			$this->data['config_center_in_bounding_box']=$this->request->post['config_center_in_bounding_box'];		
		}elseif($this->config->get('config_center_in_bounding_box')){
			$this->data['config_center_in_bounding_box']=$this->config->get('config_center_in_bounding_box');			
		}else{
			$this->data['config_center_in_bounding_box']='';
		}
		
		if(isset($this->request->post['config_upload_designs'])){
			$this->data['config_upload_designs']=$this->request->post['config_upload_designs'];		
		}elseif($this->config->get('config_upload_designs')){
			$this->data['config_upload_designs']=$this->config->get('config_upload_designs');			
		}else{
			$this->data['config_upload_designs']='';
		}
		if(isset($this->request->post['config_zoom'])){
			$this->data['config_zoom']=$this->request->post['config_zoom'];		
		}elseif($this->config->get('config_zoom')){
			$this->data['config_zoom']=$this->config->get('config_zoom');			
		}else{
			$this->data['config_zoom']='1.2';
		}
		
		if(isset($this->request->post['config_zoom_min'])){
			$this->data['config_zoom_min']=$this->request->post['config_zoom_min'];		
		}elseif($this->config->get('config_zoom_min')){
			$this->data['config_zoom_min']=$this->config->get('config_zoom_min');			
		}else{
			$this->data['config_zoom_min']='0.2';
		}
		
		if(isset($this->request->post['config_zoom_max'])){
			$this->data['config_zoom_max']=$this->request->post['config_zoom_max'];		
		}elseif($this->config->get('config_zoom_max')){
			$this->data['config_zoom_max']=$this->config->get('config_zoom_max');			
		}else{
			$this->data['config_zoom_max']='2';
		}
		
		if(isset($this->request->post['config_zoom_min'])){
			$this->data['config_zoom_min']=$this->request->post['config_zoom_min'];		
		}elseif($this->config->get('config_zoom_min')){
			$this->data['config_zoom_min']=$this->config->get('config_zoom_min');			
		}else{
			$this->data['config_zoom_min']='';
		}
		
		if(isset($this->request->post['config_instagram_client_id'])){
			$this->data['config_instagram_client_id']=$this->request->post['config_instagram_client_id'];		
		}elseif($this->config->get('config_instagram_client_id')){
			$this->data['config_instagram_client_id']=$this->config->get('config_instagram_client_id');			
		}else{
			$this->data['config_instagram_client_id']='';
		}
		
		if(isset($this->request->post['config_instagram_redirect_uri'])){
			$this->data['config_instagram_redirect_uri']=$this->request->post['config_instagram_redirect_uri'];		
		}elseif($this->config->get('config_instagram_redirect_uri')){
			$this->data['config_instagram_redirect_uri']=$this->config->get('config_instagram_redirect_uri');			
		}else{
			$this->data['config_instagram_redirect_uri']='';
		}
		
		if(isset($this->request->post['config_facebook_app_id'])){
			$this->data['config_facebook_app_id']=$this->request->post['config_facebook_app_id'];		
		}elseif($this->config->get('config_facebook_app_id')){
			$this->data['config_facebook_app_id']=$this->config->get('config_facebook_app_id');			
		}else{
			$this->data['config_facebook_app_id']='';
		}
		if(isset($this->request->post['config_designs_parameter_x'])){
			$this->data['config_designs_parameter_x']=$this->request->post['config_designs_parameter_x'];		
		}elseif($this->config->get('config_designs_parameter_x')){
			$this->data['config_designs_parameter_x']=$this->config->get('config_designs_parameter_x');			
		}else{
			$this->data['config_designs_parameter_x']= 0;
		}
		if(isset($this->request->post['config_designs_parameter_y'])){
			$this->data['config_designs_parameter_y']=$this->request->post['config_designs_parameter_y'];		
		}elseif($this->config->get('config_designs_parameter_y')){
			$this->data['config_designs_parameter_y']=$this->config->get('config_designs_parameter_y');			
		}else{
			$this->data['config_designs_parameter_y']= 0;
		}
		if(isset($this->request->post['config_designs_parameter_z'])){
			$this->data['config_designs_parameter_z']=$this->request->post['config_designs_parameter_z'];		
		}elseif($this->config->get('config_designs_parameter_z')){
			$this->data['config_designs_parameter_z']=$this->config->get('config_designs_parameter_z');			
		}else{
			$this->data['config_designs_parameter_z']= -1;
		}
		if(isset($this->request->post['config_designs_parameter_colors'])){
			$this->data['config_designs_parameter_colors']=$this->request->post['config_designs_parameter_colors'];		
		}elseif($this->config->get('config_designs_parameter_colors')){
			$this->data['config_designs_parameter_colors']=$this->config->get('config_designs_parameter_colors');			
		}else{
			$this->data['config_designs_parameter_colors']='';
		}
		if(isset($this->request->post['config_designs_parameter_price'])){
			$this->data['config_designs_parameter_price']=$this->request->post['config_designs_parameter_price'];		
		}elseif($this->config->get('config_designs_parameter_price')){
			$this->data['config_designs_parameter_price']=$this->config->get('config_designs_parameter_price');			
		}else{
			$this->data['config_designs_parameter_price']='';
		}
		if(isset($this->request->post['config_designs_parameter_auto_center'])){
			$this->data['config_designs_parameter_auto_center']=$this->request->post['config_designs_parameter_auto_center'];		
		}elseif($this->config->get('config_designs_parameter_auto_center')){
			$this->data['config_designs_parameter_auto_center']=$this->config->get('config_designs_parameter_auto_center');			
		}else{
			$this->data['config_designs_parameter_auto_center']='';
		}
		
		if(isset($this->request->post['config_designs_parameter_draggable'])){
			$this->data['config_designs_parameter_draggable']=$this->request->post['config_designs_parameter_draggable'];		
		}elseif($this->config->get('config_designs_parameter_draggable')){
			$this->data['config_designs_parameter_draggable']=$this->config->get('config_designs_parameter_draggable');			
		}else{
			$this->data['config_designs_parameter_draggable']='';
		}
		if(isset($this->request->post['config_designs_parameter_rotatable'])){
			$this->data['config_designs_parameter_rotatable']=$this->request->post['config_designs_parameter_rotatable'];		
		}elseif($this->config->get('config_designs_parameter_rotatable')){
			$this->data['config_designs_parameter_rotatable']=$this->config->get('config_designs_parameter_rotatable');			
		}else{
			$this->data['config_designs_parameter_rotatable']='';
		}
		if(isset($this->request->post['config_designs_parameter_resizable'])){
			$this->data['config_designs_parameter_resizable']=$this->request->post['config_designs_parameter_resizable'];		
		}elseif($this->config->get('config_designs_parameter_resizable')){
			$this->data['config_designs_parameter_resizable']=$this->config->get('config_designs_parameter_resizable');			
		}else{
			$this->data['config_designs_parameter_resizable']='';
		}
		if(isset($this->request->post['config_designs_parameter_zchangeable'])){
			$this->data['config_designs_parameter_zchangeable']=$this->request->post['config_designs_parameter_zchangeable'];		
		}elseif($this->config->get('config_designs_parameter_zchangeable')){
			$this->data['config_designs_parameter_zchangeable']=$this->config->get('config_designs_parameter_zchangeable');			
		}else{
			$this->data['config_designs_parameter_zchangeable']='';
		}
		if(isset($this->request->post['config_designs_parameter_autoselect'])){
			$this->data['config_designs_parameter_autoselect']=$this->request->post['config_designs_parameter_autoselect'];		
		}elseif($this->config->get('config_designs_parameter_autoselect')){
			$this->data['config_designs_parameter_autoselect']=$this->config->get('config_designs_parameter_autoselect');			
		}else{
			$this->data['config_designs_parameter_autoselect']='';
		}
		if(isset($this->request->post['config_designs_parameter_replace'])){
			$this->data['config_designs_parameter_replace']=$this->request->post['config_designs_parameter_replace'];		
		}elseif($this->config->get('config_designs_parameter_replace')){
			$this->data['config_designs_parameter_replace']=$this->config->get('config_designs_parameter_replace');			
		}else{
			$this->data['config_designs_parameter_replace']='';
		}
		if(isset($this->request->post['config_designs_parameter_clipping'])){
			$this->data['config_designs_parameter_clipping']=$this->request->post['config_designs_parameter_clipping'];		
		}elseif($this->config->get('config_designs_parameter_clipping')){
			$this->data['config_designs_parameter_clipping']=$this->config->get('config_designs_parameter_clipping');			
		}else{
			$this->data['config_designs_parameter_clipping']='';
		}
		if(isset($this->request->post['config_designs_parameter_bounding_box'])){
			$this->data['config_designs_parameter_bounding_box']=$this->request->post['config_designs_parameter_bounding_box'];		
		}elseif($this->config->get('config_designs_parameter_bounding_box')){
			$this->data['config_designs_parameter_bounding_box']=$this->config->get('config_designs_parameter_bounding_box');			
		}else{
			$this->data['config_designs_parameter_bounding_box']='';
		}
		if(isset($this->request->post['config_bounding_box_target'])){
			$this->data['config_bounding_box_target']=$this->request->post['config_bounding_box_target'];		
		}elseif($this->config->get('config_bounding_box_target')){
			$this->data['config_bounding_box_target']=$this->config->get('config_bounding_box_target');			
		}else{
			$this->data['config_bounding_box_target']='';
		}
		if(isset($this->request->post['config_text_bounding_box_target'])){
			$this->data['config_text_bounding_box_target']=$this->request->post['config_text_bounding_box_target'];		
		}elseif($this->config->get('config_text_bounding_box_target')){
			$this->data['config_text_bounding_box_target']=$this->config->get('config_text_bounding_box_target');			
		}else{
			$this->data['config_text_bounding_box_target']='';
		}
		if(isset($this->request->post['config_bounding_box_x'])){
			$this->data['config_bounding_box_x']=$this->request->post['config_bounding_box_x'];		
		}elseif($this->config->get('config_bounding_box_x')){
			$this->data['config_bounding_box_x']=$this->config->get('config_bounding_box_x');			
		}else{
			$this->data['config_bounding_box_x']='';
		}
		if(isset($this->request->post['config_bounding_box_y'])){
			$this->data['config_bounding_box_y']=$this->request->post['config_bounding_box_y'];		
		}elseif($this->config->get('config_bounding_box_y')){
			$this->data['config_bounding_box_y']=$this->config->get('config_bounding_box_y');			
		}else{
			$this->data['config_bounding_box_y']='';
		}
		if(isset($this->request->post['config_bounding_box_width'])){
			$this->data['config_bounding_box_width']=$this->request->post['config_bounding_box_width'];		
		}elseif($this->config->get('config_bounding_box_width')){
			$this->data['config_bounding_box_width']=$this->config->get('config_bounding_box_width');			
		}else{
			$this->data['config_bounding_box_width']='';
		}
		if(isset($this->request->post['config_bounding_box_height'])){
			$this->data['config_bounding_box_height']=$this->request->post['config_bounding_box_height'];		
		}elseif($this->config->get('config_bounding_box_height')){
			$this->data['config_bounding_box_height']=$this->config->get('config_bounding_box_height');			
		}else{
			$this->data['config_bounding_box_height']='';
		}
		if(isset($this->request->post['config_min_width'])){
			$this->data['config_min_width']=$this->request->post['config_min_width'];		
		}elseif($this->config->get('config_min_width')){
			$this->data['config_min_width']=$this->config->get('config_min_width');			
		}else{
			$this->data['config_min_width']='';
		}
		if(isset($this->request->post['config_min_height'])){
			$this->data['config_min_height']=$this->request->post['config_min_height'];		
		}elseif($this->config->get('config_min_height')){
			$this->data['config_min_height']=$this->config->get('config_min_height');			
		}else{
			$this->data['config_min_height']='';
		}
		if(isset($this->request->post['config_max_width'])){
			$this->data['config_max_width']=$this->request->post['config_max_width'];		
		}elseif($this->config->get('config_max_width')){
			$this->data['config_max_width']=$this->config->get('config_max_width');			
		}else{
			$this->data['config_max_width']='';
		}
		if(isset($this->request->post['config_max_height'])){
			$this->data['config_max_height']=$this->request->post['config_max_height'];		
		}elseif($this->config->get('config_max_height')){
			$this->data['config_max_height']=$this->config->get('config_max_height');			
		}else{
			$this->data['config_max_height']='';
		}
		if(isset($this->request->post['config_resize_width'])){
			$this->data['config_resize_width']=$this->request->post['config_resize_width'];		
		}elseif($this->config->get('config_resize_width')){
			$this->data['config_resize_width']=$this->config->get('config_resize_width');			
		}else{
			$this->data['config_resize_width']='';
		}
		if(isset($this->request->post['config_resize_height'])){
			$this->data['config_resize_height']=$this->request->post['config_resize_height'];		
		}elseif($this->config->get('config_resize_height')){
			$this->data['config_resize_height']=$this->config->get('config_resize_height');			
		}else{
			$this->data['config_resize_height']='';
		}
		if(isset($this->request->post['config_text_x_position'])){
			$this->data['config_text_x_position']=$this->request->post['config_text_x_position'];		
		}elseif($this->config->get('config_text_x_position')){
			$this->data['config_text_x_position']=$this->config->get('config_text_x_position');			
		}else{
			$this->data['config_text_x_position']=0;
		}
		if(isset($this->request->post['config_text_y_position'])){
			$this->data['config_text_y_position']=$this->request->post['config_text_y_position'];		
		}elseif($this->config->get('config_text_y_position')){
			$this->data['config_text_y_position']=$this->config->get('config_text_y_position');			
		}else{
			$this->data['config_text_y_position']=0;
		}
		if(isset($this->request->post['config_text_z_position'])){
			$this->data['config_text_z_position']=$this->request->post['config_text_z_position'];		
		}elseif($this->config->get('config_text_z_position')){
			$this->data['config_text_z_position']=$this->config->get('config_text_z_position');			
		}else{
			$this->data['config_text_z_position']='';
		}
		if(isset($this->request->post['config_text_replace'])){
			$this->data['config_text_replace']=$this->request->post['config_text_replace'];		
		}elseif($this->config->get('config_text_replace')){
			$this->data['config_text_replace']=$this->config->get('config_text_replace');			
		}else{
			$this->data['config_text_replace']='';
		}		
		if(isset($this->request->post['config_text_design_color'])){
			$this->data['config_text_design_color']=$this->request->post['config_text_design_color'];		
		}elseif($this->config->get('config_text_design_color')){
			$this->data['config_text_design_color']=$this->config->get('config_text_design_color');			
		}else{
			$this->data['config_text_design_color']='';
		}
		if(isset($this->request->post['config_text_design_price'])){
			$this->data['config_text_design_price']=$this->request->post['config_text_design_price'];		
		}elseif($this->config->get('config_text_design_price')){
			$this->data['config_text_design_price']=$this->config->get('config_text_design_price');			
		}else{
			$this->data['config_text_design_price']= '';
		}
		if(isset($this->request->post['config_text_auto_center'])){
			$this->data['config_text_auto_center']=$this->request->post['config_text_auto_center'];		
		}elseif($this->config->get('config_text_auto_center')){
			$this->data['config_text_auto_center']=$this->config->get('config_text_auto_center');			
		}else{
			$this->data['config_text_auto_center']=0;
		}
		if(isset($this->request->post['config_text_draggable'])){
			$this->data['config_text_draggable']=$this->request->post['config_text_draggable'];		
		}elseif($this->config->get('config_text_draggable')){
			$this->data['config_text_draggable']=$this->config->get('config_text_draggable');			
		}else{
			$this->data['config_text_draggable']='';
		}
		if(isset($this->request->post['config_text_rotatable'])){
			$this->data['config_text_rotatable']=$this->request->post['config_text_rotatable'];		
		}elseif($this->config->get('config_text_rotatable')){
			$this->data['config_text_rotatable']=$this->config->get('config_text_rotatable');			
		}else{
			$this->data['config_text_rotatable']='';
		}
		if(isset($this->request->post['config_text_resizeable'])){
			$this->data['config_text_resizeable']=$this->request->post['config_text_resizeable'];		
		}elseif($this->config->get('config_text_resizeable')){
			$this->data['config_text_resizeable']=$this->config->get('config_text_resizeable');			
		}else{
			$this->data['config_text_resizeable']='';
		}
		if(isset($this->request->post['config_text_zchangeable'])){
			$this->data['config_text_zchangeable']=$this->request->post['config_text_zchangeable'];		
		}elseif($this->config->get('config_text_zchangeable')){
			$this->data['config_text_zchangeable']=$this->config->get('config_text_zchangeable');			
		}else{
			$this->data['config_text_zchangeable']=0;
		}
		if(isset($this->request->post['config_designs_text_autoselect'])){
			$this->data['config_designs_text_autoselect']=$this->request->post['config_designs_text_autoselect'];		
		}elseif($this->config->get('config_designs_text_autoselect')){
			$this->data['config_designs_text_autoselect']=$this->config->get('config_designs_text_autoselect');			
		}else{
			$this->data['config_designs_text_autoselect']=0;
		}
		if(isset($this->request->post['config_designs_text_replace'])){
			$this->data['config_designs_text_replace']=$this->request->post['config_designs_text_replace'];		
		}elseif($this->config->get('config_designs_text_replace')){
			$this->data['config_designs_text_replace']=$this->config->get('config_designs_text_replace');			
		}else{
			$this->data['config_designs_text_replace']='';
		}
		if(isset($this->request->post['config_designs_text_clipping'])){
			$this->data['config_designs_text_clipping']=$this->request->post['config_designs_text_clipping'];		
		}elseif($this->config->get('config_designs_text_clipping')){
			$this->data['config_designs_text_clipping']=$this->config->get('config_designs_text_clipping');			
		}else{
			$this->data['config_designs_text_clipping']='';
		}
		if(isset($this->request->post['config_designs_text_bounding_box'])){
			$this->data['config_designs_text_bounding_box']=$this->request->post['config_designs_text_bounding_box'];		
		}elseif($this->config->get('config_designs_text_bounding_box')){
			$this->data['config_designs_text_bounding_box']=$this->config->get('config_designs_text_bounding_box');			
		}else{
			$this->data['config_designs_text_bounding_box']='';
		}
		if(isset($this->request->post['config_text_curved'])){
			$this->data['config_text_curved']=$this->request->post['config_text_curved'];		
		}elseif($this->config->get('config_text_curved')){
			$this->data['config_text_curved']=$this->config->get('config_text_curved');			
		}else{
			$this->data['config_text_curved']='';
		}		
		if(isset($this->request->post['config_text_text_characters'])){
			$this->data['config_text_text_characters']=$this->request->post['config_text_text_characters'];		
		}elseif($this->config->get('config_text_text_characters')){
			$this->data['config_text_text_characters']=$this->config->get('config_text_text_characters');			
		}else{
			$this->data['config_text_text_characters'] = 0;
		}
		if(isset($this->request->post['config_text_patternable'])){
			$this->data['config_text_patternable']=$this->request->post['config_text_patternable'];		
		}elseif($this->config->get('config_text_patternable')){
			$this->data['config_text_patternable']=$this->config->get('config_text_patternable');			
		}else{
			$this->data['config_text_patternable']='';
		}
		if(isset($this->request->post['config_text_bounding_x_position'])){
			$this->data['config_text_bounding_x_position']=$this->request->post['config_text_bounding_x_position'];		
		}elseif($this->config->get('config_text_bounding_x_position')){
			$this->data['config_text_bounding_x_position']=$this->config->get('config_text_bounding_x_position');			
		}else{
			$this->data['config_text_bounding_x_position']='';
		}
		if(isset($this->request->post['config_text_bounding_y_position'])){
			$this->data['config_text_bounding_y_position']=$this->request->post['config_text_bounding_y_position'];		
		}elseif($this->config->get('config_text_bounding_y_position')){
			$this->data['config_text_bounding_y_position']=$this->config->get('config_text_bounding_y_position');			
		}else{
			$this->data['config_text_bounding_y_position']='';
		}
		if(isset($this->request->post['config_text_bounding_width'])){
			$this->data['config_text_bounding_width']=$this->request->post['config_text_bounding_width'];		
		}elseif($this->config->get('config_text_bounding_width')){
			$this->data['config_text_bounding_width']=$this->config->get('config_text_bounding_width');			
		}else{
			$this->data['config_text_bounding_width']='';
		}
		if(isset($this->request->post['config_text_bounding_height'])){
			$this->data['config_text_bounding_height']=$this->request->post['config_text_bounding_height'];		
		}elseif($this->config->get('config_text_bounding_height')){
			$this->data['config_text_bounding_height']=$this->config->get('config_text_bounding_height');			
		}else{
			$this->data['config_text_bounding_height']='';
		}
		$this->template = 'catalog/fnt_setting.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'catalog/fnt_setting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}	
		return true;	
	}
}
