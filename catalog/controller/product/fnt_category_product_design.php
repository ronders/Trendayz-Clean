<?php
class ControllerProductFntCategoryProductDesign extends Controller
{
    private $error = array();
    
    public function index()
    {
        $this->load->language('product/fnt_product_design');
        $this->data['breadcrumbs'] = array();
		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
        $this->load->model('catalog/fnt_product_design');
        $this->load->model('catalog/product');
        $this->load->model('catalog/fnt_clipart');
        $this->load->model('tool/image');
        $this->load->model('catalog/fnt_category_clipart');
        $this->load->model('catalog/category');
        $this->data['domain'] = HTTP_SERVER;
        //Load product design by category design.
        
        $this->document->addStyle('catalog/view/theme/default/stylesheet/fancy_design/font-awesome/css/font-awesome.min.css');
        $this->document->addStyle('catalog/view/theme/default/stylesheet/fancy_design/jquery.fancyProductDesigner-fonts.css');
		$this->data['config_view_tooltip'] = ($this->config->get('config_view_tooltip'))?1:0;
		$this->data['config_responsive'] = ($this->config->get('config_responsive'))?1:0;
        $this->document->addStyle('catalog/view/theme/default/stylesheet/fancy_design/plugins.min.css');
        $this->document->addStyle('catalog/view/theme/default/stylesheet/fancy_design/fancy-product.css');
        $this->document->addScript('catalog/view/javascript/jquery/jquery-1.8.3.min.js');
        $this->document->addScript('catalog/view/javascript/jquery/ui/jquery-ui-1.10.4.min.js');
        $this->document->addScript('catalog/view/javascript/jspdf/jspdf.min.js');
        $this->document->addScript('catalog/view/javascript/fancy_design/jquery.form.min.js');
        $this->document->addScript('catalog/view/javascript/fancy_design/fabric.js');
        $this->document->addScript('catalog/view/javascript/fancy_design/plugins.min.js');
        $this->document->addScript('catalog/view/javascript/fancy_design/jquery.fancyProductDesigner.min.js');
        $this->document->addScript('catalog/view/javascript/login_popup.js');
        $this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
        $this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');
        
        $this->data['heading_title'] = '';
        
        $this->data['text_model']    = $this->language->get('text_model');
        $this->data['text_reward']   = $this->language->get('text_reward');
        $this->data['text_points']   = $this->language->get('text_points');
        $this->data['text_stock']    = $this->language->get('text_stock');
        $this->data['text_discount'] = $this->language->get('text_discount');
        $this->data['text_tax']      = $this->language->get('text_tax');
        $this->data['text_option']   = $this->language->get('text_option');
        $this->data['text_write']    = $this->language->get('text_write');
        $this->data['text_login']    = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
        $this->data['text_note']     = $this->language->get('text_note');
        $this->data['text_tags']     = $this->language->get('text_tags');
        $this->data['text_related']  = $this->language->get('text_related');
        $this->data['text_loading']  = $this->language->get('text_loading');
        $this->data['text_select']   = $this->language->get('text_select');
        
        $this->data['entry_qty']     = $this->language->get('entry_qty');
        $this->data['entry_name']    = $this->language->get('entry_name');
        $this->data['entry_review']  = $this->language->get('entry_review');
        $this->data['entry_rating']  = $this->language->get('entry_rating');
        $this->data['entry_good']    = $this->language->get('entry_good');
        $this->data['entry_bad']     = $this->language->get('entry_bad');
        $this->data['entry_captcha'] = $this->language->get('entry_captcha');
        
        $this->data['button_cart']     = $this->language->get('button_cart');
        $this->data['button_wishlist'] = $this->language->get('button_wishlist');
        $this->data['button_compare']  = $this->language->get('button_compare');
        $this->data['button_upload']   = $this->language->get('button_upload');
        $this->data['button_continue'] = $this->language->get('button_continue');
        
        //define text default
        $this->data['text_default']                         = $this->language->get('text_default');
        $this->data['text_out_of_containment']              = $this->language->get('text_out_of_containment');
        $this->data['text_confirm_product_delete']          = $this->language->get('text_confirm_product_delete');
        $this->data['text_cancel']                          = $this->language->get('text_cancel');
        $this->data['text_change']                          = $this->language->get('text_change');
        $this->data['text_error_upload_size']               = $this->language->get('text_error_upload_size');
        $this->data['text_init_text']                       = $this->language->get('text_init_text');
        $this->data['text_my_upload_image']                 = $this->language->get('text_my_upload_image');
        $this->data['text_design_menu']                     = $this->language->get('text_design_menu');
        $this->data['text_edit_element_menu']               = $this->language->get('text_edit_element_menu');
        $this->data['text_fb_photo_menu']                   = $this->language->get('text_fb_photo_menu');
        $this->data['text_insta_photo_menu']                = $this->language->get('text_insta_photo_menu');
        $this->data['text_edit_element_headline']           = $this->language->get('text_edit_element_headline');
        $this->data['text_edit_element_dropdown_none']      = $this->language->get('text_edit_element_dropdown_none');
        $this->data['text_section_filling']                 = $this->language->get('text_section_filling');
        $this->data['text_section_font_style']              = $this->language->get('text_section_font_style');
        $this->data['text_section_curved_text']             = $this->language->get('text_section_curved_text');
        $this->data['text_section_helpers']                 = $this->language->get('text_section_helpers');
        $this->data['text_align_left']                      = $this->language->get('text_align_left');
        $this->data['text_align_center']                    = $this->language->get('text_align_center');
        $this->data['text_align_right']                     = $this->language->get('text_align_right');
        $this->data['text_bold']                            = $this->language->get('text_bold');
        $this->data['text_italic']                          = $this->language->get('text_italic');
        $this->data['text_curved_text_info']                = $this->language->get('text_curved_text_info');
        $this->data['text_curved_text_spacing']             = $this->language->get('text_curved_text_spacing');
        $this->data['text_curved_text_radius']              = $this->language->get('text_curved_text_radius');
        $this->data['text_curved_text_reverse']             = $this->language->get('text_curved_text_reverse');
        $this->data['text_text_toggle']                     = $this->language->get('text_text_toggle');
        $this->data['text_center_h']                        = $this->language->get('text_center_h');
        $this->data['text_center_v']                        = $this->language->get('text_center_v');
        $this->data['text_move_down']                       = $this->language->get('text_move_down');
        $this->data['text_move_up']                         = $this->language->get('text_move_up');
        $this->data['text_reset']                           = $this->language->get('text_reset');
        $this->data['text_fb']                              = $this->language->get('text_fb');
        $this->data['text_fb_select_friend']                = $this->language->get('text_fb_select_friend');
        $this->data['text_fb_select_album']                 = $this->language->get('text_fb_select_album');
        $this->data['text_insta_photo_headline']            = $this->language->get('text_insta_photo_headline');
        $this->data['text_insta_feed_button']               = $this->language->get('text_insta_feed_button');
        $this->data['text_insta_recent_image_button']       = $this->language->get('text_insta_recent_image_button');
        $this->data['text_insta_load_next']                 = $this->language->get('text_insta_load_next');
        $this->data['text_add_image_tooltip']               = $this->language->get('text_add_image_tooltip');
        $this->data['text_add_text_tooltip']                = $this->language->get('text_add_text_tooltip');
        $this->data['text_zoom_in_tooltip']                 = $this->language->get('text_zoom_in_tooltip');
        $this->data['text_zoom_out_tooltip']                = $this->language->get('text_zoom_out_tooltip');
        $this->data['text_zoom_reset_tooltip']              = $this->language->get('text_zoom_reset_tooltip');
        $this->data['text_download_image_tooltip']          = $this->language->get('text_download_image_tooltip');
        $this->data['text_print_tooltip']                   = $this->language->get('text_print_tooltip');
        $this->data['text_pdf_tooltip']                     = $this->language->get('text_pdf_tooltip');
        $this->data['text_save_product_tooltip']            = $this->language->get('text_save_product_tooltip');
        $this->data['text_save_products_tooltip']           = $this->language->get('text_save_products_tooltip');
        $this->data['text_reset_tooltip']                   = $this->language->get('text_reset_tooltip');
        $this->data['text_share_design']                    = $this->language->get('text_share_design');
        $this->data['text_share_image']                     = $this->language->get('text_share_image');
        $this->data['text_save_design']                     = $this->language->get('text_save_design');       
        $this->data['text_save_image']                      = $this->language->get('text_save_image');       
        $this->data['text_order']                           = $this->language->get('text_order');       
        $this->data['text_confirm_design']                     = $this->language->get('text_confirm_design');       
        //Get setting config
        $this->data['config_designs_parameter_x']           = $this->config->get('config_designs_parameter_x') ? $this->config->get('config_designs_parameter_x') : 0;
        $this->data['config_designs_parameter_y']           = $this->config->get('config_designs_parameter_y') ? $this->config->get('config_designs_parameter_y') : 0;
        $this->data['config_designs_parameter_z']           = $this->config->get('config_designs_parameter_z') ? $this->config->get('config_designs_parameter_z') : -1;
        $this->data['config_designs_parameter_price']       = $this->config->get('config_designs_parameter_price') ? $this->config->get('config_designs_parameter_price') : 0;
        $this->data['config_designs_parameter_colors']      = $this->config->get('config_designs_parameter_colors') ? $this->config->get('config_designs_parameter_colors') : '#000000';
        $this->data['config_designs_parameter_auto_center'] = $this->config->get('config_designs_parameter_auto_center') ? $this->config->get('config_designs_parameter_auto_center') : 0;
        $this->data['config_designs_parameter_draggable']   = $this->config->get('config_designs_parameter_draggable') ? $this->config->get('config_designs_parameter_draggable') : 0;
        $this->data['config_designs_parameter_rotatable']   = $this->config->get('config_designs_parameter_rotatable') ? $this->config->get('config_designs_parameter_rotatable') : 0;
        $this->data['config_designs_parameter_resizable']   = $this->config->get('config_designs_parameter_resizable') ? $this->config->get('config_designs_parameter_resizable') : 0;
        $this->data['config_designs_parameter_zchangeable'] = $this->config->get('config_designs_parameter_zchangeable') ? $this->config->get('config_designs_parameter_zchangeable') : 0;
        $this->data['config_designs_parameter_remove']      = $this->config->get('config_designs_parameter_remove') ? $this->config->get('config_designs_parameter_remove') : 0;
        $this->data['config_designs_parameter_replace']     = $this->config->get('config_designs_parameter_replace') ? 'image' : '';
        $this->data['config_designs_parameter_autoselect']  = $this->config->get('config_designs_parameter_autoselect') ? $this->config->get('config_designs_parameter_autoselect') : 0;
		if ($this->config->get('config_designs_parameter_bounding_box')) {
			if ($this->config->get('config_bounding_box_target')) {
				$this->data['config_designs_parameter_aboundingbox'] = $this->config->get('config_bounding_box_target') ? '"' . $this->config->get('config_bounding_box_target') . '"' : '';
			} elseif ($this->config->get('config_bounding_box_x') != '' && $this->config->get('config_bounding_box_y') != '' && $this->config->get('config_bounding_box_width') != '' && $this->config->get('config_bounding_box_height') != '') {
				$this->data['config_designs_parameter_aboundingbox'] = '{ "x":' . $this->config->get('config_bounding_box_x') . ', "y":' . $this->config->get('config_bounding_box_y') . ', "width":' . $this->config->get('config_bounding_box_width') . ', "height":' . $this->config->get('config_bounding_box_height') . '}';
			} else {
				$this->data['config_designs_parameter_aboundingbox'] = '""';
			}
		} else {
				$this->data['config_designs_parameter_aboundingbox'] = '""';
		}	
        $this->data['config_designs_parameter_clipping'] = $this->config->get('config_designs_parameter_clipping') ? $this->config->get('config_designs_parameter_clipping') : 0;
        $this->data['config_min_width']                  = $this->config->get('config_min_width') ? $this->config->get('config_min_width') : 100;
        $this->data['config_min_height']                 = $this->config->get('config_min_height') ? $this->config->get('config_min_height') : 100;
        $this->data['config_max_width']                  = $this->config->get('config_max_width') ? $this->config->get('config_max_width') : 1000;
        $this->data['config_max_height']                 = $this->config->get('config_max_height') ? $this->config->get('config_max_height') : 1000;
        $this->data['config_resize_width']               = $this->config->get('config_resize_width') ? $this->config->get('config_resize_width') : 300;
        $this->data['config_resize_height']              = $this->config->get('config_resize_height') ? $this->config->get('config_resize_height') : 300;
        
        $this->data['config_upload_designs']         = $this->config->get('config_upload_designs') ? 1 : 0;
        $this->data['config_upload_text']            = $this->config->get('config_upload_text') ? 1 : 0;
        $this->data['config_download_image']         = $this->config->get('config_download_image') ? 1 : 0;
        $this->data['config_pdf_button']             = $this->config->get('config_pdf_button') ? 1 : 0;
        $this->data['config_print_button']           = $this->config->get('config_print_button') ? 1 : 0;
        $this->data['config_allow_product_saving']   = $this->config->get('config_allow_product_saving') ? 1 : 0;
        $this->data['config_reset_table']            = $this->config->get('config_reset_table') ? 1 : 0;
        $this->data['config_font_dropdown']          = $this->config->get('config_font_dropdown') ? 1 : 0;
        $this->data['config_facebook_app_id']        = $this->config->get('config_facebook_app_id') ? $this->config->get('config_facebook_app_id') : '1390864391178492';
        $this->data['config_instagram_client_id']    = $this->config->get('config_instagram_client_id') ? $this->config->get('config_instagram_client_id') : '';
        $this->data['config_instagram_redirect_uri'] = $this->config->get('config_instagram_redirect_uri') ? HTTP_SERVER . $this->config->get('config_instagram_redirect_uri') : '';
        $this->data['config_view_selection_float']   = $this->config->get('config_view_selection_float') ? 1 : 0;
        $this->data['config_show_popup_view']        = $this->config->get('config_show_popup_view') ? 1 : 0;
        $this->data['config_zoom']                   = $this->config->get('config_zoom') ? $this->config->get('config_zoom') : 1.2;
        $this->data['config_zoom_min']               = $this->config->get('config_zoom_min') ? $this->config->get('config_zoom_min') : 0.2;
        $this->data['config_zoom_max']               = $this->config->get('config_zoom_max') ? $this->config->get('config_zoom_max') : 2;
        $this->data['config_text_text_default']      = $this->config->get('config_text_text_default') ? $this->config->get('config_text_text_default') : 'Double-click to change text';
        $this->data['config_tooltip']                = $this->config->get('config_tooltip') ? $this->config->get('config_tooltip') : 0;	
		if($this->config->get('config_text_patternable')){
			$this->data['patternable'] = 1;
			$this->data['patterns'] = $this->get_pattern_urls();
		} else {
			$this->data['patterns'] = array();
			$this->data['patternable'] = 0;
		}
        $this->data['config_color_sidebar']          = $this->config->get('config_color_sidebar') ? $this->config->get('config_color_sidebar') : '#2c3e50';
        $this->data['config_color_icon']             = $this->config->get('config_color_icon') ? $this->config->get('config_color_icon') : '#f6f6f6';
        $this->data['config_selected_color']         = $this->config->get('config_selected_color') ? $this->config->get('config_selected_color') : '#d5d5d5';
        $this->data['config_bounding_color']         = $this->config->get('config_bounding_color') ? $this->config->get('config_bounding_color') : '#005ede';
        $this->data['config_out_boundary_color']     = $this->config->get('config_out_boundary_color') ? $this->config->get('config_out_boundary_color') : '#990000';
        $this->data['config_default_text_size']      = $this->config->get('config_default_text_size') ? $this->config->get('config_default_text_size') : 12;
        $this->data['config_text_x_position']        = $this->config->get('config_text_x_position') ? $this->config->get('config_text_x_position') : 0;
        $this->data['config_text_y_position']        = $this->config->get('config_text_y_position') ? $this->config->get('config_text_y_position') : 0;
        $this->data['config_text_z_position']        = $this->config->get('config_text_z_position') ? $this->config->get('config_text_z_position') : -1;
        $this->data['config_text_design_color']      = $this->config->get('config_text_design_color') ? $this->config->get('config_text_design_color') : '#000000';
        $this->data['config_text_design_price']      = $this->config->get('config_text_design_price') ? $this->config->get('config_text_design_price') : 0;
        $this->data['config_text_auto_center']       = $this->config->get('config_text_auto_center') ? $this->config->get('config_text_auto_center') : 0;
        $this->data['config_text_draggable']         = $this->config->get('config_text_draggable') ? $this->config->get('config_text_draggable') : 0;
        $this->data['config_text_rotatable']         = $this->config->get('config_text_rotatable') ? $this->config->get('config_text_rotatable') : 0;
        $this->data['config_text_resizeable']        = $this->config->get('config_text_resizeable') ? $this->config->get('config_text_resizeable') : 0;
        $this->data['config_text_zchangeable']       = $this->config->get('config_text_zchangeable') ? $this->config->get('config_text_zchangeable') : 0;
        $this->data['config_text_autoselected']      = $this->config->get('config_text_autoselected') ? $this->config->get('config_text_autoselected') : 0;
        $this->data['config_text_remove']            = $this->config->get('config_text_remove') ? $this->config->get('config_text_remove') : 0;
        $this->data['config_default_text_size']      = $this->config->get('config_default_text_size') ? $this->config->get('config_default_text_size') : 12;
        $this->data['config_text_text_characters']   = $this->config->get('config_text_text_characters') ? $this->config->get('config_text_text_characters') : 0;
        $this->data['config_text_curved']            = $this->config->get('config_text_curved') ? $this->config->get('config_text_curved') : 0;
        
		if ($this->config->get('config_designs_text_bounding_box')) {
			if ($this->config->get('config_text_bounding_box_target')) {
				$this->data['config_designs_text_aboundingbox'] = $this->config->get('config_text_bounding_box_target') ? '"' . $this->config->get('config_text_bounding_box_target') . '"' : '';
			} elseif ($this->config->get('config_text_bounding_x_position') != '' && $this->config->get('config_text_bounding_y_position') != '' && $this->config->get('config_text_bounding_width') != '' && $this->config->get('config_text_bounding_height') != '') {
				$this->data['config_designs_text_aboundingbox'] = '{ "x":' . $this->config->get('config_text_bounding_x_position') . ', "y":' . $this->config->get('config_text_bounding_y_position') . ', "width":' . $this->config->get('config_text_bounding_width') . ', "height":' . $this->config->get('config_text_bounding_height') . '}';
			} else {
				$this->data['config_designs_text_aboundingbox'] = '';
			}
		} else {
				$this->data['config_designs_text_aboundingbox'] = '';
		}	
        $this->data['config_designs_text_clipping'] = $this->config->get('config_designs_text_clipping') ? $this->config->get('config_designs_text_clipping') : 0;
        
        $this->data['config_sidebar_content_width'] = $this->config->get('config_sidebar_content_width') ? $this->config->get('config_sidebar_content_width') : 325;
        $this->data['config_stage_width']           = $this->config->get('config_stage_width') ? $this->config->get('config_stage_width') : 650;
        $this->data['config_stage_height']          = $this->config->get('config_stage_height') ? $this->config->get('config_stage_height') : 550;
        $this->data['config_stage_max_width']       = $this->config->get('config_stage_max_width') ? $this->config->get('config_stage_max_width') : 650;
		if($this->config->get('config_responsive')){
			$this->data['config_sidebar_height']       = $this->config->get('config_stage_height') + 54;
		}else {
			if($this->data['config_stage_width'] > $this->data['config_stage_max_width']){
				$this->data['config_sidebar_height']       = $this->config->get('config_stage_height') * ($this->data['config_stage_max_width']/$this->data['config_stage_width']) + 54;	
			} else {
				$this->data['config_sidebar_height']       = $this->config->get('config_stage_height') + 54;	
			}
		}
		$this->data['hide_designs_tab'] = 0;
		$fonts_defaults = array();
			if($this->config->get('fonts_default')){
			$fonts_default = explode(',',$this->config->get('fonts_default'));
		} else {
			$fonts_default = array('Arial','Helvetica','Times New Roman','Verdana','Geneva');
		}
		if($fonts_default){
			foreach ($fonts_default as $font) {
				$fonts_defaults[] = "'" . $font . "'";
            }
		}
        $fonts_googles = array();
        $fonts_google = $this->config->get('fonts');
        if ($fonts_google) {
            foreach ($fonts_google as $font) {
                $str = str_replace(' ', '+', $font);
                $this->document->addLink('http://fonts.googleapis.com/css?family=' . $str, 'stylesheet');
                $fonts_googles[] = "'" . $font . "'";
            }
        } 
		
		$fonts_directorys = array();
        $fonts_directory = $this->config->get('fonts_woff');
        if ($fonts_directory) {
            foreach ($fonts_directory as $font) {
                $fonts_directorys[] = "'" .  preg_replace("/\\.[^.\\s]{3,4}$/", "", $font) . "'";
            }
        }
		$this->data['fonts']  = implode(',',array_merge($fonts_defaults,$fonts_googles,$fonts_directorys));
        //Get list Clipart
        $this->data['cliparts']           = array();
        $this->data['products']           = array();
        $data                             = array(
            'filter_status' => '1',
            'sort'          => 'p.date_added',
            'order'         => 'DESC'
        );
        $this->data['currency_value']     = round($this->currency->getValue(), (int) $this->currency->getDecimalPlace());
        $this->data['currency']           = $this->currency->getCode();
        $this->data['curency_code_left']  = $this->currency->getSymbolLeft();
        $this->data['curency_code_right'] = $this->currency->getSymbolRight();
        $this->data['decimal_place']      = $this->currency->getDecimalPlace();
        //Case exist $this->request->get['product_design_id']
        if (isset($this->request->get['product_design_id'])) {
            $product_design_id = (int) $this->request->get['product_design_id'];
        } else {
            $product_design_id = 0;
        }
        
        //Case edit design form session cart
        if (isset($this->request->get['key'])) {
            $keyscart          = explode(':', $this->request->get['key']);
            $product_design_id = $keyscart[3];
            if (isset($this->session->data['cart-design'][$this->request->get['key']])) {
                $this->data['design'] = html_entity_decode(base64_decode($this->session->data['cart-design'][$this->request->get['key']]['product']), ENT_QUOTES, 'UTF-8');
            } else {
                return;
            }
        }
        //Case edit design form order
        if (isset($this->request->get['order_id']) && isset($this->request->get['order_product_id'])) {
            $this->load->model('account/order');
            $order_product_info = $this->model_account_order->getProductOrderDesign($this->request->get['order_id'], $this->request->get['order_product_id']);
            if ($order_product_info) {
                $this->data['design'] = html_entity_decode(base64_decode($order_product_info['design']), ENT_QUOTES, 'UTF-8');
                $product_design_id    = $order_product_info['product_design_id'];
            }
        }
		//Case view product share or product design ideas accept
		
		if (isset($this->request->get['product_customer_idea_id'])) {

            $product_customer_idea_id = (int)$this->request->get['product_customer_idea_id'];

            $this->data['product_customer_idea_id'] = (int)$this->request->get['product_customer_idea_id'];

			$product_idea_info = $this->model_catalog_fnt_product_design->getProductCustomerIdea($product_customer_idea_id);
			$this->data['design'] = html_entity_decode($product_idea_info['data_design']);

			$product_design_id = $product_idea_info['product_design_id'];

        } elseif(isset($this->request->get['product_customer_idea_accept_id'])) {
			
			$this->load->model('catalog/fnt_customer_design');	
			
			$product_customer_idea_accept_id = $this->request->get['product_customer_idea_accept_id'];

			$this->data['product_customer_idea_accept_id'] = (int)$this->request->get['product_customer_idea_accept_id'];

			$product_idea_info = $this->model_catalog_fnt_customer_design->getProductDesignIdeaAccept($product_customer_idea_accept_id);
			if($product_idea_info){
				$this->data['design'] = html_entity_decode($product_idea_info['data_design']);
					
				$product_design_id = $product_idea_info['product_design_id'];
				//if logged in as admin, active function edit customer design idea on FO
				$this->load->library('user');
				$this->user = new User($this->registry);
				if($this->user->isLogged()){
					$this->data['user_id'] = $this->user->getId();
				} 
			}	

        }
		//Case edit customer design
        if (isset($this->request->get['product_customer_idea_id'])) {
            $this->load->model('account/fnt_customer_ideas');
            $product_ideas_info = $this->model_account_fnt_customer_ideas->getCustomerIdea($this->request->get['product_customer_idea_id']);
            if ($product_ideas_info) {
                $this->data['design'] = html_entity_decode($product_ideas_info['data_design'], ENT_QUOTES, 'UTF-8');
                $product_design_id    = $product_ideas_info['product_design_id'];
            }
        }
        $this->data['products_design'] = array();
        $this->data['product_ideas']   = array();
        $this->data['options']         = array();
		  
		//Get options for product design
        if (isset($this->data['design'])) {
            $product_design_info = $this->model_catalog_fnt_product_design->getProductDesign($product_design_id);
            if ($product_design_info) {
				$this->data['heading_title'] = $product_design_info['name'];
                $product_info = $this->model_catalog_product->getProduct($product_design_info['product_id']);
                if ($product_info) {
					$this->document->setTitle($product_info['name']);
					$this->document->setDescription($product_info['meta_description']);
					$this->document->setKeywords($product_info['meta_keyword']);
					if ($product_info['minimum']) {
						$this->data['minimum'] = $product_info['minimum'];
					} else {
						$this->data['minimum'] = 1;
					}
					
					if ($product_info['special']) {
						$this->data['price'] = $product_info['special'];
					} else {
						$this->data['price'] = $product_info['price'];
					}
					$this->data['product_design_id'] =  $product_design_id;
					$this->data['product_id'] =  $product_design_info['product_id'];
                    foreach ($this->model_catalog_product->getProductOptions($product_design_info['product_id']) as $option) {
                        if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                            $option_value_data = array();
                            
                            foreach ($option['option_value'] as $option_value) {
                                if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                                    if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float) $option_value['price']) {
                                        $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                                    } else {
                                        $price = false;
                                    }
                                    
                                    $option_value_data[] = array(
                                        'product_option_value_id' => $option_value['product_option_value_id'],
                                        'option_value_id' => $option_value['option_value_id'],
                                        'name' => $option_value['name'],
                                        'image' => $this->model_tool_image->resize($option_value['image'], 50, 50),
                                        'price' => $price,
                                        'price_prefix' => $option_value['price_prefix']
                                    );
                                }
                            }
                            
                            $this->data['options'][] = array(
                                'product_option_id' => $option['product_option_id'],
                                'option_id' => $option['option_id'],
                                'name' => $option['name'],
                                'type' => $option['type'],
                                'option_value' => $option_value_data,
                                'required' => $option['required']
                            );
                        } elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                            $this->data['options'][] = array(
                                'product_option_id' => $option['product_option_id'],
                                'option_id' => $option['option_id'],
                                'name' => $option['name'],
                                'type' => $option['type'],
                                'option_value' => $option['option_value'],
                                'required' => $option['required']
                            );
                        }
                    }
                }
            }
        } else {
            //get all product design
            $results = $this->model_catalog_fnt_product_design->getProductDesigns($data);
			
            if ($results) {
				if($product_design_id){
					if(!$this->config->get('config_view_all_design')){
						$results = $this->getArrayByProductDesignId($results, $product_design_id);
					} else {
						$results = $this->sortArrayByProductDesignId($results, $product_design_id);
						$this->document->setTitle($this->language->get('title_design'));
						$this->document->setDescription($this->config->get('config_meta_description'));
						$this->document->setKeywords($this->config->get('config_meta_keyword'));
						$flag = 1;
						$this->data['breadcrumbs'][] = array(
							'text' => $this->language->get('title_design'),
							'href' => $this->url->link('product/fnt_category_product_design')
						);
					}	
				} elseif(!$this->config->get('config_view_all_design')){
					$this->redirect($this->url->link('common/not_found'));
				} else {
					$this->document->setTitle($this->language->get('title_design'));
					$this->document->setDescription($this->config->get('config_meta_description'));
					$this->document->setKeywords($this->config->get('config_meta_keyword'));
					$this->data['breadcrumbs'][] = array(
						'text' => $this->language->get('title_design'),
						'href' => $this->url->link('product/fnt_category_product_design')
					);
					$flag = 1;
				}
                foreach ($results as $keyproduct => $result) {
                    $product_design_info = $this->model_catalog_fnt_product_design->getProductDesign($result['product_design_id']);
                    
                    if ($product_design_info) {
                        $product_info = $this->model_catalog_product->getProduct($product_design_info['product_id']);
                        if ($product_info) {
							if(!isset($flag)){
								$this->document->setTitle($product_info['name']);
								$this->document->setDescription($product_info['meta_description']);
								$this->document->setKeywords($product_info['meta_keyword']);
								$this->data['breadcrumbs'][] = array(
									'text' => $product_design_info['name'],
									'href' => $this->url->link('product/fnt_category_product_design','product_design_id=' . $result['product_design_id'])
								);
								$flag = 1;
							}
                            $products_design_element = $this->model_catalog_fnt_product_design->getProductDesignImages($result['product_design_id']);
                            if ($products_design_element) {
                                $product_element = array();
                                foreach ($products_design_element as $product_design_element) {
                                    $product_design_element_detail = array();
                                    $elements = $this->model_catalog_fnt_product_design->getProductDesignElement($product_design_element['product_design_element_id']);
                                    if ($elements) { 
                                        foreach ($elements as $element) {
                                            $parameters = unserialize($element['parameters']);
											$title = $parameters['title_element'];
											unset($parameters['title_element']);
										   $parameters_string = $this->convert_parameters_to_string($parameters);
											if($element['type'] == 'image'){
												$element['value'] = HTTP_SERVER . 'image/' . $element['value'];
											}
                                            $product_design_element_detail[] = array(
                                                'type' => $element['type'],
                                                'title' => $title,
                                                'value' => $element['value'],
                                                'parameters' => $parameters_string
                                            );
                                            
                                        }
                                    }
                                    $product_element[] = array(
                                        'product_design_element_id' => $product_design_element['product_design_element_id'],
                                        'name' => $product_design_element['name'],
                                        'image' => HTTP_SERVER . 'image/' . $product_design_element['image'],
                                        'children' => $product_design_element_detail
                                    );
                                }
                            }
                            if (isset($product_element[0])) {
                                $first_design = $product_element[0];
                                unset($product_element[0]);
                            } else {
                                $first_design = array();
                            }
							if($first_design){
								$this->data['products_design'][] = array(
									'product_design_element_id' => $product_design_element['product_design_element_id'],
									'name' => $product_info['name'],
									'image' => $this->model_tool_image->resize($products_design_element[0]['image'], 100, 100),
									'product_design_id' => $result['product_design_id'],
									'first_element' => $first_design,
									'children' => $product_element
								);
							}	
                            if ($keyproduct == 0) {
								$this->data['heading_title'] = $product_design_info['name'];
								if ($product_info['minimum']) {
									$this->data['minimum'] = $product_info['minimum'];
								} else {
									$this->data['minimum'] = 1;
								}
								if ($product_info['special']) {
									$this->data['price'] = $product_info['special'];
								} else {
									$this->data['price'] = $product_info['price'];
								}
								$this->data['product_design_id'] =  $result['product_design_id'];
								$this->data['product_id'] =  $product_design_info['product_id'];
                                foreach ($this->model_catalog_product->getProductOptions($product_design_info['product_id']) as $option) {
                                    if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                                        $option_value_data = array();
                                        
                                        foreach ($option['option_value'] as $option_value) {
                                            if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                                                if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float) $option_value['price']) {
                                                    $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                                                } else {
                                                    $price = false;
                                                }
                                                
                                                $option_value_data[] = array(
                                                    'product_option_value_id' => $option_value['product_option_value_id'],
                                                    'option_value_id' => $option_value['option_value_id'],
                                                    'name' => $option_value['name'],
                                                    'image' => $this->model_tool_image->resize($option_value['image'], 50, 50),
                                                    'price' => $price,
                                                    'price_prefix' => $option_value['price_prefix']
                                                );
                                            }
                                        }
                                        
                                        $this->data['options'][] = array(
                                            'product_option_id' => $option['product_option_id'],
                                            'option_id' => $option['option_id'],
                                            'name' => $option['name'],
                                            'type' => $option['type'],
                                            'option_value' => $option_value_data,
                                            'required' => $option['required']
                                        );
                                    } elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                                        $this->data['options'][] = array(
                                            'product_option_id' => $option['product_option_id'],
                                            'option_id' => $option['option_id'],
                                            'name' => $option['name'],
                                            'type' => $option['type'],
                                            'option_value' => $option['option_value'],
                                            'required' => $option['required']
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
				$this->redirect('common/not_found');
			}
            
            //Get all product ideas			
            $elements_ideas = $this->model_catalog_fnt_product_design->getAllProductIdeas($product_design_id);
            if ($elements_ideas) {
                foreach ($elements_ideas as $elements_idea) {
                    $product_idea = array();
					
					$product_design_info = $this->model_catalog_fnt_product_design->getProductDesign($result['product_design_id']);
                    $product_info = $this->model_catalog_product->getProduct($product_design_info['product_id']);
					 
					$products_ideas_element =  $this->model_catalog_fnt_product_design->getProductIdeaElements($elements_idea['product_ideas_id']);
					if($products_ideas_element){
                    foreach ($products_ideas_element as $products_idea_element) {
                        $product_design_element_detail = array();
                        $elements = $this->model_catalog_fnt_product_design->getProductIdeaElement($products_idea_element['product_ideas_element_id']);
                        if ($elements) {
                            foreach ($elements as $element) {
                                $parameters = unserialize($element['parameters']);
								$title = $parameters['title_element'];
								unset($parameters['title_element']);
                               $parameters_string = $this->convert_parameters_to_string($parameters);
								if($element['type'] == 'image'){
									$element['value'] = HTTP_SERVER . 'image/' . $element['value'];
								}
                                $product_design_element_detail[] = array(
                                    'type' => $element['type'],
                                    'title' => $title,
                                    'value' => $element['value'],
                                    'parameters' => $parameters_string
                                );
                                
                            }
                        }
                        $product_idea[] = array(
                            'product_design_element_id' => $products_idea_element['product_ideas_element_id'],
                            'name' => $products_idea_element['name'],
                            'image' => $this->model_tool_image->resize($products_idea_element['image'], 100, 100),
                            'children' => $product_design_element_detail
                        );
                    }
                    if (isset($product_idea[0])) {
                        $first_element = $product_idea[0];
                        unset($product_idea[0]);
                    } else {
                        $first_element = array();
                    }
					if(isset($products_ideas_element[0])){
						$image_first_design = $this->model_tool_image->resize($products_ideas_element[0]['image'], 100, 100);
					} else {
						$image_first_design = $this->model_tool_image->resize('no_image.jpg', 100, 100);
					}
                    $this->data['product_ideas'][] = array(
                        'product_design_id' => $elements_idea['product_design_id'],
                        'name' => $elements_idea['name'],
                        'image' => $image_first_design,
                        'first_element' => $first_element,
                        'children' => $product_idea
                    );
                }
            }
        }
        }
        //Get Clipart 
		$data = array();
		if(!$this->config->get('config_view_all_design')){
			$data['list_product'] = $product_design_id;
			$this->data['group_class'] = 'fpd-product';
		} else {
			$this->data['group_class'] = 'fpd-product-ideas';
		}
        $categories_clipart = $this->model_catalog_fnt_category_clipart->getCategoriesClipart($data);
        if ($categories_clipart) {
            foreach ($categories_clipart as $category_clipart_id => $parameter) {
				$parameter_cat_temp = unserialize($parameter);
				if(isset($parameter_cat_temp['status']) && $parameter_cat_temp['status']){$tem_parameter = $parameter_cat_temp;}
                $category_info = $this->model_catalog_fnt_category_clipart->getCategoryClipartDescriptions($category_clipart_id);
                if ($category_info) {
                    $category_name = $category_info['name'];
                } else {
                    $category_name = 'Cliart';
                }
                $children_clipart = array();
                $cliparts         = $this->model_catalog_fnt_clipart->getClipartByCategory($category_clipart_id);
					if ($cliparts) {                        foreach ($cliparts as $clipart_id) {                            $clipart_info = $this->model_catalog_fnt_clipart->getClipart($clipart_id);
						                            if ($clipart_info) {								$parameter_clipart_temp = unserialize($clipart_info['parameter']);								if (isset($parameter_clipart_temp['status']) && $parameter_clipart_temp['status']) {
									$tem_parameter = $parameter_clipart_temp;																}
								if (isset($tem_parameter)) {
																		$parameters  = '{"x":'.(int)$tem_parameter['x'].',"y":'.(int)$tem_parameter['y'].',"colors": "'.(string)$tem_parameter['colors'].'", "zChangeable":'.$tem_parameter['zChangeable'].', "removable":' . $tem_parameter['removable'].', "draggable":'.$tem_parameter['draggable']. ', "rotatable":'.$tem_parameter['rotatable'] .', "resizable":'. $tem_parameter['resizable'].', "autoCenter":'.$tem_parameter['auto_center']. ',"autoSelect":'.$tem_parameter['auto_select']. ', "price":' . (int)$tem_parameter['price'] . ',"boundingBox": ' . $this->data['config_designs_parameter_aboundingbox']. ',"scale":'.(float)$tem_parameter['scale'].',"replace":"'.$tem_parameter['replace'].'", "boundingBoxClipping" :'. $this->data['config_designs_parameter_clipping'] .'}';										} else {									$parameters  = '{"x":0,"y":0,"colors": "#000000", "zChangeable": true, "removable": true, "draggable": true, "rotatable": true, "resizable": true, "autoCenter": true, "price":0,"boundingBox": ' . $this->data['config_designs_parameter_aboundingbox']. ',"scale":0.5, "boundingBoxClipping" :'. $this->data['config_designs_parameter_clipping'] .'}';																	}																$children_clipart[] = array(                                    'name' => $clipart_info['name'],                                    'image' => HTTP_SERVER . 'image/' . $clipart_info['image'],                                    'parameters' => $parameters                                );								                            }                        }                    }
                
                if ($cliparts) {
                    $this->data['cliparts'][] = array(
                        'name' => $category_name,
                        'category_clipart_id' => $category_clipart_id,
                        'children' => $children_clipart
                    );
                }
            }
        }
        $this->data['customer_id']  = 0;
        $this->data['custom_ideas'] = array();
        //Get Custom Ideas
        if ($this->customer->isLogged()) {
            $this->data['customer_id'] = $this->customer->getId();
            $custom_ideas              = $this->model_catalog_fnt_product_design->getIdeasByCustomer($this->customer->getId());
            if ($custom_ideas) {
                foreach ($custom_ideas as $custom_idea) {
                    $this->data['custom_ideas'][] = $custom_idea['data_design'];
                }
            }
        }
		
		//Get setting for product design 
		if(isset($product_design_id) && $product_design_id && !$this->config->get('config_view_all_design')){
			$parameters = $this->model_catalog_fnt_product_design->getSettingParameters($product_design_id);
			if($parameters){
				$parameters = unserialize($parameters['parameters']);
				$this->data['config_designs_parameter_price'] = (int)$parameters['designs_parameter_price'];
				if($parameters['background_type'] == 'image'){
					if($parameters['image']){
						$this->data['image_background'] = HTTP_SERVER . 'image/' . $parameters['image'];
					}
				} else if($parameters['background_type'] == 'color'){
					$this->data['color_background'] = $parameters['background_color'];
				}
				if(isset($parameters['hide_facebook_tab'])){
					$this->data['config_facebook_app_id'] = '';
				}
				if(isset($parameters['hide_instagram_tab'])){
					$this->data['config_instagram_client_id'] = '';
					$this->data['config_instagram_redirect_uri'] = '';
				}
				if(isset($parameters['hide_designs_tab'])){
					$this->data['hide_designs_tab'] = 1;
				}
				if ($parameters['designs_parameter_bounding_box_control'] == 1) {
					if ($parameters['designs_parameter_bounding_box_x'] != '' && $parameters['designs_parameter_bounding_box_y'] != '' && $parameters['designs_parameter_bounding_box_width'] != '' && $parameters['designs_parameter_bounding_box_height'] != '') {
						$this->data['config_designs_parameter_aboundingbox'] = '{ "x":' . $parameters['designs_parameter_bounding_box_x'] . ', "y":' . $parameters['designs_parameter_bounding_box_y'] . ', "width":' . $parameters['designs_parameter_bounding_box_width'] . ', "height":' . $parameters['designs_parameter_bounding_box_height'] . '}';
					}
				} elseif($parameters['designs_parameter_bounding_box_control'] == 2){
					$this->data['config_designs_parameter_aboundingbox'] = '"' . $parameters['designs_parameter_bounding_box_by_other'] . '"';
				}
				$this->data['config_min_width']              = $parameters['uploaded_designs_parameter_minW'] ? $parameters['uploaded_designs_parameter_minW'] : $this->data['config_min_width'];
				$this->data['config_min_height']             = $parameters['uploaded_designs_parameter_minH'] ? $parameters['uploaded_designs_parameter_minH'] : $this->data['config_min_height'];
				$this->data['config_max_width']              = $parameters['uploaded_designs_parameter_maxW'] ? $parameters['uploaded_designs_parameter_maxW'] : $this->data['config_max_width'];
				$this->data['config_max_height']             = $parameters['uploaded_designs_parameter_maxH'] ? $parameters['uploaded_designs_parameter_maxH'] : $this->data['config_max_height'];
				$this->data['config_resize_width']           = $parameters['uploaded_designs_parameter_resizeToW'] ? $parameters['uploaded_designs_parameter_resizeToW'] : $this->data['config_resize_width'];
				$this->data['config_resize_height']          = $parameters['uploaded_designs_parameter_resizeToH'] ? $parameters['uploaded_designs_parameter_resizeToH'] : $this->data['config_resize_height'];
				
				$this->data['config_upload_designs']         = (isset($parameters['hide_custom_image_upload'])) ? 0 : $this->data['config_upload_designs'];
				$this->data['config_upload_text']            = (isset($parameters['hide_custom_text'])) ? 0 : $this->data['config_upload_text'];
				$this->data['config_view_selection_float']   = (isset($parameters['view_selection_floated'])) ? 1 : 0;
				$this->data['config_text_text_default']      = $parameters['default_text'] ? $parameters['default_text'] : $this->data['config_text_text_default'];
				$this->data['config_text_design_color']      = $parameters['custom_texts_parameter_colors'] ? $parameters['custom_texts_parameter_colors'] : $this->data['config_text_design_color'];
				$this->data['config_text_design_price']      = $parameters['custom_texts_parameter_price'] ? $parameters['custom_texts_parameter_price'] : 0;
				if ($parameters['custom_texts_parameter_bounding_box_control'] == 1) {
					if ($parameters['custom_texts_parameter_bounding_box_x'] != '' && $parameters['custom_texts_parameter_bounding_box_y'] != '' && $parameters['custom_texts_parameter_bounding_box_width'] != '' && $parameters['custom_texts_parameter_bounding_box_height'] != '') {
						$this->data['config_designs_text_aboundingbox'] = '{ "x":' . $parameters['custom_texts_parameter_bounding_box_x'] . ', "y":' . $parameters['custom_texts_parameter_bounding_box_y'] . ', "width":' . $parameters['custom_texts_parameter_bounding_box_width'] . ', "height":' . $parameters['custom_texts_parameter_bounding_box_height'] . '}';
					}
				} elseif($parameters['custom_texts_parameter_bounding_box_control'] == 2){
					$this->data['config_designs_text_aboundingbox'] = '"' . $parameters['custom_texts_parameter_bounding_box_by_other'] . '"';
				}
				$this->data['config_stage_width']           = $parameters['stage_width'] ? $parameters['stage_width'] : $this->data['config_stage_width'];
				$this->data['config_stage_height']          = $parameters['stage_height'] ? $parameters['stage_height'] : $this->data['config_stage_height'];
				if($this->config->get('config_responsive')){
					$this->data['config_sidebar_height']      = $parameters['stage_height'] ? $parameters['stage_height'] + 54 : $this->data['config_stage_height'];
				}else {
					if($this->data['config_stage_width'] > $this->data['config_stage_max_width']){
						$this->data['config_sidebar_height']       = $this->data['config_stage_height'] * ($this->data['config_stage_max_width']/$this->data['config_stage_width'])  + 54 ;
					} else {
						$this->data['config_sidebar_height']       = $this->data['config_stage_height'];	
					}
				}
				if($parameters['layout'] != ''){
					if($parameters['layout'] != 'semantic'){
						$this->document->addStyle('catalog/view/theme/default/stylesheet/fancy_design/jquery.fancyProductDesigner.css');
					} else {
						$this->document->addStyle('catalog/view/javascript/fancy_design/semantic/css/semantic.min.css');
						$this->document->addStyle('catalog/view/theme/default/stylesheet/fancy_design/jquery.fancyProductDesigner-semantic.css');
					}
					$this->data['theme'] = $parameters['layout'];
				} else {
					if($this->config->get('config_theme') != 'semantic'){
						$this->document->addStyle('catalog/view/theme/default/stylesheet/fancy_design/jquery.fancyProductDesigner.css');
					} else {
						$this->document->addStyle('catalog/view/javascript/fancy_design/semantic/css/semantic.min.css');
						$this->document->addStyle('catalog/view/theme/default/stylesheet/fancy_design/jquery.fancyProductDesigner-semantic.css');
					}
					$this->data['theme'] = $this->config->get('config_theme');
				}
			}
		} else {
			if($this->config->get('config_theme') != 'semantic'){
				$this->document->addStyle('catalog/view/theme/default/stylesheet/fancy_design/jquery.fancyProductDesigner.css');
			} else {
				$this->document->addStyle('catalog/view/javascript/fancy_design/semantic/css/semantic.min.css');
				$this->document->addStyle('catalog/view/theme/default/stylesheet/fancy_design/jquery.fancyProductDesigner-semantic.css');
			}
			$this->data['theme'] = $this->config->get('config_theme');
		}
        $this->data['link_save'] = $this->url->link('account/fnt_login_popup');
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/fnt_category_product_design.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/product/fnt_category_product_design.tpl';
        } else {
            $this->template = 'default/template/product/fnt_category_product_design.tpl';
        }
        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_top',
            'common/content_bottom',
            'common/footer',
            'common/header'
        );
        $this->response->setOutput($this->render());
    }
    
    public function loadProductDetail()
    {
        $json = array();
        $this->load->language('product/fnt_product_design');
        $this->load->model('catalog/fnt_product_design');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');
        $this->data['button_upload'] = $this->language->get('button_upload');
        if (isset($this->request->get['product_design_id']) && ($this->request->get['product_design_id'])) {
            $json['currency_value']    = round($this->currency->getValue(), (int) $this->currency->getDecimalPlace());
            $json['product_design_id'] = $this->request->get['product_design_id'];
            $json['curency_code']      = $this->currency->getSymbolLeft();
            if (!$json['curency_code']) {
                $json['curency_code'] = $this->currency->getSymbolRight();
            }
            $this->data['button_cart'] = $this->language->get('button_cart');
            $this->data['entry_qty']   = $this->language->get('entry_qty');
            $this->data['text_select'] = $this->language->get('text_select');
            $product_design_info       = $this->model_catalog_fnt_product_design->getProductDesign($this->request->get['product_design_id']);
            if ($product_design_info) {
                $product_info = $this->model_catalog_product->getProduct($product_design_info['product_id']);
                if ($product_info) {
                    $json['product_id']    = $product_info['product_id'];
                    $json['price_product'] = $product_info['price'];
                    if ((float) $product_info['special']) {
                        $json['price_product'] = $product_info['special'];
                    } else {
                        $json['price_product'] = $product_info['price'];
                    }
                    if ($product_info['minimum']) {
                        $json['minimum'] = $product_info['minimum'];
                    } else {
                        $json['minimum'] = 1;
                    }
                    
                    $this->data['options'] = array();
                    foreach ($this->model_catalog_product->getProductOptions($product_design_info['product_id']) as $option) {
                        if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                            $option_value_data = array();
                            
                            foreach ($option['option_value'] as $option_value) {
                                if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                                    if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float) $option_value['price']) {
                                        $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                                    } else {
                                        $price = false;
                                    }
                                    
                                    $option_value_data[] = array(
                                        'product_option_value_id' => $option_value['product_option_value_id'],
                                        'option_value_id' => $option_value['option_value_id'],
                                        'name' => $option_value['name'],
                                        'image' => $this->model_tool_image->resize($option_value['image'], 50, 50),
                                        'price' => $price,
                                        'price_prefix' => $option_value['price_prefix']
                                    );
                                }
                            }
                            
                            $this->data['options'][] = array(
                                'product_option_id' => $option['product_option_id'],
                                'option_id' => $option['option_id'],
                                'name' => $option['name'],
                                'type' => $option['type'],
                                'option_value' => $option_value_data,
                                'required' => $option['required']
                            );
                        } elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                            $this->data['options'][] = array(
                                'product_option_id' => $option['product_option_id'],
                                'option_id' => $option['option_id'],
                                'name' => $option['name'],
                                'type' => $option['type'],
                                'option_value' => $option['option_value'],
                                'required' => $option['required']
                            );
                        }
                    }
                    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/fnt_product_option.tpl')) {
                        $this->template = $this->config->get('config_template') . '/template/module/fnt_product_option.tpl';
                    } else {
                        $this->template = 'default/template/module/fnt_product_option.tpl';
                    }
                }
            }
        }
        $json['option'] = $this->render();
        $this->response->setOutput(json_encode($json));
    }
    public function upload()
    {
        $this->language->load('product/product');
        
        $json = array();
        
        if (!empty($this->request->files['file']['name'])) {
            $filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));
            
            if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
                $json['error'] = $this->language->get('error_filename');
            }
            
            // Allowed file extension types
            $allowed = array();
            
            $filetypes = explode("\n", $this->config->get('config_file_extension_allowed'));
            
            foreach ($filetypes as $filetype) {
                $allowed[] = trim($filetype);
            }
            
            if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
                $json['error'] = $this->language->get('error_filetype');
            }
            
            // Allowed file mime types        
            $allowed = array();
            
            $filetypes = explode("\n", $this->config->get('config_file_mime_allowed'));
            
            foreach ($filetypes as $filetype) {
                $allowed[] = trim($filetype);
            }
            
            if (!in_array($this->request->files['file']['type'], $allowed)) {
                $json['error'] = $this->language->get('error_filetype');
            }
            
            if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
                $json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
            }
        } else {
            $json['error'] = $this->language->get('error_upload');
        }
        
        if (!$json && is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
            $file = basename($filename) . '.' . md5(mt_rand());
            
            // Hide the uploaded file name so people can not link to it directly.
            $json['file'] = $this->encryption->encrypt($file);
            
            move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $file);
            
            $json['success'] = $this->language->get('text_upload');
        }
        
        $this->response->setOutput(json_encode($json));
    }
    public function filter_product()
    {
        
        $this->load->model('catalog/fnt_product_design');
        
        $this->load->model('tool/image');
        
        $this->data['products'] = array();
        if ($this->request->post['filter_name']) {
            $filter_name = $this->request->post['filter_name'];
        } else {
            $filter_name = '';
        }
        if (isset($this->request->post['page'])) {
            $page = $this->request->post['page'];
        } else {
            $page = 1;
        }
        if ($this->request->post['filter_category']) {
            $filter_category_id = $this->request->post['filter_category'];
        } else {
            $filter_category_id = 0;
        }
        if ($this->request->post['filter_manufacturer']) {
            $filter_manufacturer_id = $this->request->post['filter_manufacturer'];
        } else {
            $filter_manufacturer_id = 0;
        }
        $data = array(
            'filter_name' => $filter_name,
            'filter_category_id' => $filter_category_id,
            'filter_manufacturer_id' => $filter_manufacturer_id,
            'sort' => 'p.date_added',
            'order' => 'DESC',
            'start' => ($page - 1) * 35
        );
        
        $results = $this->model_catalog_fnt_product_design->getProducts($data);
        foreach ($results as $result) {
            if (file_exists(DIR_IMAGE . $result['image'])) {
                $image       = $this->model_tool_image->resize($result['image'], 40, 40);
                $image_popup = $this->model_tool_image->resize($result['image'], 200, 200);
            } else {
                $image       = $this->model_tool_image->resize('no_image.jpg', 40, 40);
                $image_popup = $this->model_tool_image->resize('no_image.jpg', 200, 200);
            }
            
            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $price = false;
            }
            
            if ((float) $result['special']) {
                $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $special = false;
            }
            
            if ($this->config->get('config_review_status')) {
                $rating = $result['rating'];
            } else {
                $rating = false;
            }
            
            $this->data['products'][] = array(
                'product_id' => $result['product_id'],
                'thumb' => $image,
                'image_popup' => $image_popup,
                'name' => $result['name'],
                'price' => $price,
                'special' => $special,
                'rating' => $rating,
                'href' => $this->url->link('product/fnt_product_design', 'product_design_id=' . $result['product_design_id'])
            );
        }
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/fnt_list_filter_design.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/fnt_list_filter_design.tpl';
        } else {
            $this->template = 'default/template/module/fnt_list_filter_design.tpl';
        }
        $this->response->setOutput($this->render());
    }
	private function sortArrayByProductDesignId($array , $product_design_id) {
		foreach($array as $key => $value){
			if($value['product_design_id'] == $product_design_id){
				unset($array[$key]);
				array_unshift($array,$value);
				break;
			}
		}
		return $array;
	}
	private function getArrayByProductDesignId($array , $product_design_id) {
		foreach($array as $key => $value){
			if($value['product_design_id'] == $product_design_id){
				$array = array();
				array_unshift($array,$value);
				break;
			}
		}
		return $array;
	}

	private function get_pattern_urls() {

			$urls = array();

			$path = DIR_IMAGE . 'data/patterns/';
		  	$folder = opendir($path);

			$pic_types = array("jpg", "jpeg", "png");
			while ($file = readdir ($folder)) {

			  if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$pic_types)) {
				  $urls[] = HTTP_SERVER . 'image/data/patterns/' . $file;
			  }
			}

			closedir($folder);

			return $urls;

		}
		public function loadClipartByCategory(){

		$this->load->model('catalog/fnt_clipart');

        $this->load->model('catalog/fnt_category_clipart');

		$json = array();

		if($this->request->get['category_design']){

			$cliparts = $this->model_catalog_fnt_clipart->getClipartByName($this->request->get['category_design']);

			if ($cliparts) {

				foreach ($cliparts as $clipart_id) {

					$clipart_info = $this->model_catalog_fnt_clipart->getClipart($clipart_id);

					if ($clipart_info) {

						$parameters = '{"x":300,"y":275,"colors": "#000000", "zChangeable": true, "removable": true, "draggable": true, "rotatable": true, "resizable": true, "autoCenter": true, "price":' . $clipart_info['price'] .',"boundingBox": "Box"}';

						$json['cliparts'][] = array(

							'name'		 => $clipart_info['name'],

							'image' 	 => HTTP_SERVER . 'image/' . $clipart_info['image'],

							'parameters' => $parameters

						);

					}

				}

			}

		}

		$this->response->setOutput(json_encode($json));

	}

	public function saveDesignCustomer(){

		$this->load->model('catalog/fnt_product_design');

		$json=array();

		if($this->customer->getId()){

			$customer_id = $this->customer->getId();

		} else {

			$customer_id = 0;

		}

		$product_design_info = $this->model_catalog_fnt_product_design->getProductDesign($this->request->get['product_design_id']);
		if($this->request->post['base64_image']){

			$product_customer_idea_id = $this->model_catalog_fnt_product_design->addProductIdeaCustomer($this->request->get['product_design_id'],$this->request->post['base64_image'],$customer_id,$product_design_info['name']);

			$json['success'] = $this->url->link('product/fnt_category_product_design','product_customer_idea_id='.$product_customer_idea_id);

		}

		if(!$json){

			$json['error'] = 1;

		}

		$this->response->setOutput(json_encode($json));

	}

	public function saveCustomDesignIdea(){

		$this->load->model('catalog/fnt_product_design');

		$json=array();

		if($this->customer->getId()){

			$customer_id = $this->customer->getId();

		} else {

			$customer_id = 0;

		}

		$product_customer_idea_id = $this->model_catalog_fnt_product_design->addProductIdeaCustomer($this->session->data['product_design_id'],$this->session->data['base64_image'],$customer_id,$this->request->post['name_design']);

		unset($this->session->data['product_design_id']);

		unset($this->session->data['base64_image']);

		$this->response->setOutput(json_encode($json));

	}

	public function editDesignCustomerAprroved(){
	
		$this->load->language('product/fnt_product_design');
		$json = array();
		$this->load->model('catalog/fnt_product_design');
		
		$this->model_catalog_fnt_product_design->editDesignCustomerAprroved($this->request->get['product_customer_idea_accept_id'], $this->request->post['base64_image']);
		$json['success'] = $this->language->get('text_success_edit_design');
		$this->response->setOutput(json_encode($json));
	}

	public function saveProductDesignSession(){

		if(isset($this->request->post['base64_image'])){

			$this->session->data['base64_image'] = $this->request->post['base64_image'];

			$this->session->data['product_design_id'] = $this->request->get['product_design_id'];

		}
	}

	public function creatImageShare(){

			if ( !isset($this->request->post['base64_image']))

			    exit;

			//create fancy product orders directory

			if( !file_exists(DIR_IMAGE) )

				mkdir(DIR_IMAGE);



			//create uploads dir

			$images_dir = DIR_IMAGE . 'design_products_share/';

		

			if( !file_exists($images_dir) )

				mkdir($images_dir);

			$images_dir = DIR_IMAGE . 'design_products_share/images/';

		

			if( !file_exists($images_dir) )

				mkdir($images_dir);

			$png_path =  $images_dir . md5(mt_rand()).'.png';



			$image_exist = file_exists($png_path);



			

			//get the base-64 from data

			$base64_str = substr($this->request->post['base64_image'], strpos($this->request->post['base64_image'], ",")+1);	

			//decode base64 string

			$decoded = base64_decode($base64_str);

			

			$result = file_put_contents($png_path, $decoded);

			$png_path = str_replace(DIR_IMAGE,HTTP_SERVER . 'image/',$png_path);

			if($result){

				$json['code'] = $image_exist ? 302 : 201; 

				$json['url'] = $png_path;

				$this->response->setOutput(json_encode($json));

			}else {

				$json['code'] = 500;

				$json['url'] = $png_path;

				$this->response->setOutput(json_encode($json));

			}

	}

	

//returns the current folder URL

public function get_folder_url() {

	$url = $_SERVER['REQUEST_URI']; //returns the current URL

	$parts = explode('/',$url);

	$dir = $_SERVER['SERVER_NAME'];

	for ($i = 0; $i < count($parts) - 1; $i++) {

		$dir .= $parts[$i] . "/";

	}

	return 'http://'.$dir;

}	public function convert_parameters_to_string($parameters) {
		
			if( empty($parameters) ) { return '{}'; }

			$params_object = '{';
			foreach($parameters as $key => $value) {

				if( $this->fpd_not_empty($value) ) {

					//convert boolean value to integer
					if(is_bool($value)) { $value = (int) $value; }

					switch($key) {
						case 'x':
							$params_object .= '"x":'. $value .',';
						break;
						case 'y':
							$params_object .= '"y":'. $value .',';
						break;
						case 'z':
							$params_object .= '"z":'. $value .',';
						break;
						case 'colors':
							$params_object .= '"colors":"'. (is_array($value) ? implode(", ", $value) : $value) .'",';
						break;
						case 'removable':
							$params_object .= '"removable":'. $value .',';
						break;
						case 'draggable':
							$params_object .= '"draggable":'. $value .',';
						break;
						case 'rotatable':
							$params_object .= '"rotatable":'. $value .',';
						break;
						case 'resizable':
							$params_object .= '"resizable":'. $value .',';
						break;
						case 'removable':
							$params_object .= '"removable":'. $value .',';
						break;
						case 'zChangeable':
							$params_object .= '"zChangeable":'. $value .',';
						break;
						case 'scale':
							$params_object .= '"scale":'. $value .',';
						break;
						case 'angle':
							$params_object .= '"degree":'. $value .',';
						break;
						case 'price':
							$params_object .= '"price":'. $value .',';
						break;
						case 'autoCenter':
							$params_object .= '"autoCenter":'. $value .',';
						break;
						case 'font':
							$params_object .= '"font":"'. $value .'",';
						break;
						case 'patternable':
							$params_object .= '"patternable":'. $value .',';
						break;
						case 'textSize':
							$params_object .= '"textSize":'. $value .',';
						break;
						case 'editable':
							$params_object .= '"editable":'. $value .',';
						break;
						case 'replace':
							$params_object .= '"replace":"'. $value .'",';
						break;
						case 'autoSelect':
							$params_object .= '"autoSelect":'. $value .',';
						break;
						case 'topped':
							$params_object .= '"topped":'. $value .',';
						break;
						case 'boundingBoxClipping':
							$params_object .= '"boundingBoxClipping":'. $value .',';
						break;
						case 'maxLength':
							$params_object .= '"maxLength":'. $value .',';
						break;
						case 'fontWeight':
							$params_object .= '"fontWeight":"'. $value .'",';
						break;
						case 'fontStyle':
							$params_object .= '"fontStyle":"'. $value .'",';
						break;
						case 'textAlign':
							$params_object .= '"textAlign":"'. $value .'",';
						break;
						case 'curvable':
							$params_object .= '"curvable":'. $value .',';
						break;
						case 'curved':
							$params_object .= '"curved":'. $value .',';
						break;
						case 'curveSpacing':
							$params_object .= '"curveSpacing":'. $value .',';
						break;
						case 'curveRadius':
							$params_object .= '"curveRadius":'. $value .',';
						break;
						case 'curveReverse':
							$params_object .= '"curveReverse":'. $value .',';
						break;
						case 'opacity':
							$params_object .= '"opacity":'. $value .',';
						break;
						case 'minW':
							$params_object .= '"minW":'. $value .',';
						break;
						case 'minH':
							$params_object .= '"minH":'. $value .',';
						break;
						case 'maxW':
							$params_object .= '"maxW":'. $value .',';
						break;
						case 'maxH':
							$params_object .= '"maxH":'. $value .',';
						break;
						case 'resizeToW':
							$params_object .= '"resizeToW":'. $value .',';
						break;
						case 'resizeToH':
							$params_object .= '"resizeToH":'. $value .',';
						break;
						case 'currentColor':
							$params_object .= '"currentColor":"'. $value .'",';
						break;
						case 'uploadZone':
							$params_object .= '"uploadZone":'. $value .',';
						break;
					}
				}
			}

			//bounding box
			if( empty($parameters['bounding_box_control']) ) {

				//use custom bounding box
				if(isset($parameters['bounding_box_x']) &&
				   isset($parameters['bounding_box_y']) &&
				   isset($parameters['bounding_box_width']) &&
				   isset($parameters['bounding_box_height'])
				   ) {

					if( $this->fpd_not_empty($parameters['bounding_box_x']) && $this->fpd_not_empty($parameters['bounding_box_y']) && $this->fpd_not_empty($parameters['bounding_box_width']) && $this->fpd_not_empty($parameters['bounding_box_height']) ) {
						$params_object .= '"boundingBox": { "x":'. $parameters['bounding_box_x'] .', "y":'. $parameters['bounding_box_y'] .', "width":'. $parameters['bounding_box_width'] .', "height":'. $parameters['bounding_box_height'] .'}';

					}
				}

			}
			else if ( isset($parameters['bounding_box_by_other']) && $this->fpd_not_empty(trim($parameters['bounding_box_by_other'])) ) {
				$params_object .= '"boundingBox": "'. $parameters['bounding_box_by_other'] .'"';
			}
			$params_object = trim($params_object, ',');
			$params_object .= '}';
			$params_object = str_replace('_', ' ', $params_object);
			return $params_object;

		}
		
		public function fpd_not_empty($value) {

			$value = trim($value);
			return $value == '0' || !empty($value);

		}
		public function validateOption(){
			$this->language->load('checkout/cart');
			$json = array();

			if (isset($this->request->post['product_id'])) {
				$product_id = $this->request->post['product_id'];
			} else {
				$product_id = 0;
			}

			$this->load->model('catalog/product');

			$product_info = $this->model_catalog_product->getProduct($product_id);

			if ($product_info) {			
				if (isset($this->request->post['quantity'])) {
					$quantity = $this->request->post['quantity'];
				} else {
					$quantity = 1;
				}

				if (isset($this->request->post['option'])) {
					$option = array_filter($this->request->post['option']);
				} else {
					$option = array();	
				}
				
				$product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);

				foreach ($product_options as $product_option) {
					if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
						$json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
					}
				}
				$this->response->setOutput(json_encode($json));		
			}
		}
}