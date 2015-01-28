<?php
class ControllerCatalogFntCustomDesign extends Controller
{
    private $error = array();

    public function index()
    {
        $this->load->language('catalog/fnt_custom_design');
        //Include Css, jquery, google font		
        $this->data['fonts'] = '';
	
	//	$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
		$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');
        $this->document->addStyle('view/stylesheet/css_fancy/plugins.min.css');
        $this->document->addStyle('view/stylesheet/css_fancy/jquery.fancyProductDesigner.css');
        $this->document->addStyle('view/stylesheet/css_fancy/jquery.fancyProductDesigner-fonts.css');
        $this->document->addStyle('view/stylesheet/css_fancy/tagmanager.css');
        $this->document->addStyle('view/stylesheet/css_fancy/admin.css');

        $this->document->addScript('view/javascript/jquery/jquery-1.8.0.min.js');
        $this->document->addScript('view/javascript/jquery/ui/jquery-ui.min.js');
		$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
		$this->document->addScript('view/javascript/jquery/superfish/js/superfish.js');
        $this->document->addScript('view/javascript/js_fancy/js/fabric.js');
        $this->document->addScript('view/javascript/js_fancy/js/fancy.min.js');
        $this->document->addScript('view/javascript/js_fancy/js/webfont.js');
		$this->document->addScript('view/javascript/js_fancy/js/plugins.min.js');
      //  $this->document->addScript('view/javascript/js_fancy/js/jquery.fancyProductDesigner.min.js');
        $this->document->addScript('view/javascript/js_fancy/js/product-builder.js');
        $this->document->addScript('view/javascript/js_fancy/js/tagmanager.js');
		$this->data['domain']   = HTTP_CATALOG;
		$fonts_defaults = array();
		$fonts_default = explode(',',$this->config->get('fonts_default'));
		if($fonts_default){
			foreach ($fonts_default as $font) {
				$fonts_defaults[] = $font;
            }
		}
        $fonts_googles = array();
        $fonts_google = $this->config->get('fonts');
        if ($fonts_google) {
            foreach ($fonts_google as $font) {
                $str = str_replace(' ', '+', $font);
                $this->document->addLink('http://fonts.googleapis.com/css?family=' . $str, 'stylesheet');
                $fonts_googles[] = $font;
            }
        } 
		
		$fonts_directorys = array();
        $fonts_directory = $this->config->get('fonts_woff');
        if ($fonts_directory) {
            foreach ($fonts_directory as $font) {
                $fonts_directorys[] = preg_replace("/\\.[^.\\s]{3,4}$/", "", $font);
            }
        }
		$this->data['fonts']  = array_merge($fonts_defaults,$fonts_googles,$fonts_directorys);
		$this->data['config_stage_width']           = $this->config->get('config_stage_width') ? $this->config->get('config_stage_width') : 650;
        $this->data['config_stage_height']          = $this->config->get('config_stage_height') ? $this->config->get('config_stage_height') : 550;
        $this->document->setTitle($this->language->get('heading_title'));
		$this->data['heading_title'] = $this->language->get('heading_title');
        $this->load->model('catalog/fnt_product_design');
        $this->load->model('catalog/fnt_product_ideas');
        $this->load->model('catalog/fnt_category_clipart');
        $this->load->model('catalog/fnt_clipart');
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'separator' => false,
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'separator' => ':',
			'href' => $this->url->link('catalog/fnt_custom_design', 'token=' . $this->session->data['token'], 'SSL')
		);
		
        $this->data['products_design_element'] = array();
        $this->data['products_ideas_element'] = array();
		$this->data['product_design_element_id'] = 0;
		$this->data['text_form'] = $this->language->get('text_form');
		//define parameter
		$this->data['text_select_product'] = $this->language->get('text_select_product');
		$this->data['text_position'] = $this->language->get('text_position');
		$this->data['text_x'] = $this->language->get('text_x');
		$this->data['text_y'] = $this->language->get('text_y');
		$this->data['text_scale'] = $this->language->get('text_scale');
		$this->data['text_angle'] = $this->language->get('text_angle');
		$this->data['text_price'] = $this->language->get('text_price');
		$this->data['text_opacity'] = $this->language->get('text_opacity');
		$this->data['text_colors'] = $this->language->get('text_colors');
		$this->data['text_removable'] = $this->language->get('text_removable');
		$this->data['text_draggable'] = $this->language->get('text_draggable');
		$this->data['text_rotatable'] = $this->language->get('text_rotatable');
		$this->data['text_resizable'] = $this->language->get('text_resizable');
		$this->data['text_z_position'] = $this->language->get('text_z_position');
		$this->data['text_stay_on_top'] = $this->language->get('text_stay_on_top');
		$this->data['text_auto_select'] = $this->language->get('text_auto_select');
		$this->data['text_bounding_box'] = $this->language->get('text_bounding_box');
		$this->data['text_use_another_element'] = $this->language->get('text_use_another_element');
		$this->data['text_clip_element_into_bounding_box'] = $this->language->get('text_clip_element_into_bounding_box');
		$this->data['text_modifications'] = $this->language->get('text_modifications');
		$this->data['text_width'] = $this->language->get('text_width');
		$this->data['text_height'] = $this->language->get('text_height');
		$this->data['text_title_of_an_image_element'] = $this->language->get('text_title_of_an_image_element');
		$this->data['text_replace'] = $this->language->get('text_replace');
		$this->data['text_elements_with'] = $this->language->get('text_elements_with');
		$this->data['text_font'] = $this->language->get('text_font');
		$this->data['text_select_a_font'] = $this->language->get('text_select_a_font');
		$this->data['text_styling'] = $this->language->get('text_styling');
		$this->data['text_alignment'] = $this->language->get('text_alignment');
		$this->data['text_text_alignment'] = $this->language->get('text_text_alignment');
		$this->data['text_maximum_characters'] = $this->language->get('text_maximum_characters');
		$this->data['text_editable'] = $this->language->get('text_editable');
		$this->data['text_patternable'] = $this->language->get('text_patternable');
		$this->data['text_curvable'] = $this->language->get('text_curvable');
		$this->data['text_use_always_a_dot'] = $this->language->get('text_use_always_a_dot');
		$this->data['text_a_value_between'] = $this->language->get('text_a_value_between');
		$this->data['text_one_color_value'] = $this->language->get('text_one_color_value');
		$this->data['text_enter_hex_colors_by'] = $this->language->get('text_enter_hex_colors_by');
		$this->data['text_e_g'] = $this->language->get('text_e_g');
		$this->data['text_select_view'] = $this->language->get('text_select_view');
		$this->data['text_manage_elements'] = $this->language->get('text_manage_elements');
		$this->data['text_add_image'] = $this->language->get('text_add_image');
		$this->data['text_add_text'] = $this->language->get('text_add_text');
		$this->data['text_drag_list'] = $this->language->get('text_drag_list');
		$this->data['text_edit_parameters'] = $this->language->get('text_edit_parameters');
		$this->data['text_product_stage'] = $this->language->get('text_product_stage');
		$this->data['text_problems'] = $this->language->get('text_problems');
		$this->data['text_help_text_problems'] = $this->language->get('text_help_text_problems');
		$this->data['text_add_curved_text'] = $this->language->get('text_add_curved_text');
		$this->data['text_add_upload_zone'] = $this->language->get('text_add_upload_zone');
		$this->data['text_current_color'] = $this->language->get('text_current_color');
		$this->data['text_curved'] = $this->language->get('text_curved');
		$this->data['text_spacing'] = $this->language->get('text_spacing');
		$this->data['text_radius'] = $this->language->get('text_radius');
		$this->data['text_reverse'] = $this->language->get('text_reverse');
		$this->data['button_save_design'] = $this->language->get('button_save_design');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['cancel'] = $this->url->link('catalog/fnt_product_design', 'token=' . $this->session->data['token'], 'SSL');
		
        if (isset($this->request->get['product_design_id'])) {
            $this->data['product_design_id'] = $this->request->get['product_design_id'];
            if (isset($this->request->get['product_design_element_id'])) {
                $this->data['product_design_element_id'] = $this->request->get['product_design_element_id'];
                $product_design_element = $this->model_catalog_fnt_product_design->getProductDesignImage($this->request->get['product_design_element_id']);
                if ($product_design_element) {
                    $this->data['name'] = $product_design_element['name'];
                    $this->data['image'] = HTTP_CATALOG . 'image/' . $product_design_element['image'];
                }
            } else {
                $product_design_element = $this->model_catalog_fnt_product_design->getProductDesignFirstImage($this->request->get['product_design_id']);
                if ($product_design_element) {
                    $this->data['product_design_element_id'] = $product_design_element['product_design_element_id'];
                    $this->data['name'] = $product_design_element['name'];
                    $this->data['image'] = HTTP_CATALOG . 'image/' . $product_design_element['image'];
                }
            }

            //Get All list product element
            $products_design = $this->model_catalog_fnt_product_design->getProductDesigns();
            if ($products_design) {
                foreach ($products_design as $product_design) {
                    $children = array();
                    $products_design_element = $this->model_catalog_fnt_product_design->getProductDesignImages($product_design['product_design_id']);
                    if ($products_design_element) {
                        foreach ($products_design_element as $product_design_element) {
                            $children[] = array(
                                'product_design_element_id' => $product_design_element['product_design_element_id'],
                                'name' => $product_design_element['name']
                            );
                        }
                    }
                    $this->data['products_design_element'][] = array(
                        'id' => $product_design['product_design_id'],
                        'name' => $product_design['name'],
                        'children' => $children
                    );				
                }
				
            }
        } elseif (isset($this->request->get['product_ideas_id'])) {
            $this->data['product_ideas_id'] = $this->request->get['product_ideas_id'];
            $product_ideas_info = $this->model_catalog_fnt_product_ideas->getProductIdea($this->request->get['product_ideas_id']);
            if ($product_ideas_info) {
                if (isset($this->request->get['product_ideas_element_id'])) {
                    $this->data['product_ideas_element_id'] = $this->request->get['product_ideas_element_id'];
                    $product_idea_element = $this->model_catalog_fnt_product_ideas->getProductIdeaElement($this->request->get['product_ideas_element_id']);
                    if ($product_idea_element) {
                        $this->data['name'] = $product_idea_element['name'];
                        $this->data['image'] = HTTP_CATALOG . 'image/' . $product_idea_element['image'];
                    }
                } else {
                    $product_idea_element = $this->model_catalog_fnt_product_ideas->getProductIdeaFirstImage($product_ideas_info['product_ideas_id']);
                    if ($product_idea_element) {
                        $this->data['product_ideas_element_id'] = $product_idea_element['product_ideas_element_id'];
                        $this->data['name'] = $product_idea_element['name'];
                        $this->data['image'] = HTTP_CATALOG . 'image/' . $product_idea_element['image'];
                    }
                }
				
				 //Get product element for Product Idea form product design
				$products_ideas = $this->model_catalog_fnt_product_ideas->getProductIdeas($data = array('filter_product_design_id' => $product_ideas_info['product_design_id']));

				if ($products_ideas) {
					foreach ($products_ideas as $product_ideas) {
						$children = array();
						$products_ideas_element = $this->model_catalog_fnt_product_ideas->getProductIdeasElement($product_ideas['product_ideas_id']);
						
						if ($products_ideas_element) {
							foreach ($products_ideas_element as $products_idea_element) {
								$children[] = array(
									'product_ideas_element_id' => $products_idea_element['product_ideas_element_id'],
									'name' => $products_idea_element['name']
								);
							}
						}
						$this->data['products_ideas_element'][] = array(
							'id' => $this->request->get['product_ideas_id'],
							'name' => $product_ideas['name'],
							'children' => $children
						);
					} 
				}
            } else {
				$this->data['product_ideas_element_id'] = 0;
			}
		
        } 
        $this->data['products_design'] = array();

        $this->data['token'] = $this->request->get['token'];
        $this->data['dir_image'] = HTTP_CATALOG . 'image/';
       
            if (isset($this->data['product_design_id'])) {
                $elements = $this->model_catalog_fnt_product_design->getProductDesignElement($this->data['product_design_element_id']);
               
				if ($elements) {
                    foreach ($elements as $element) {
                        $parameters = unserialize($element['parameters']);
						$title = $parameters['title_element'];
						unset($parameters['title_element']);
                        $this->data['products_design'][] = array(
                            'type' => $element['type'],
                            'title' => $title,
                            'value' => $element['value'],
                            'parameters' => http_build_query($parameters)
                        );
                    }
				
                }
            } elseif(isset($this->data['product_ideas_id'])) {
                $elements = $this->model_catalog_fnt_product_ideas->getProductIdeasElementDetail($this->data['product_ideas_element_id']);
               if ($elements) {
                    foreach ($elements as $element) {
                        $parameters = unserialize($element['parameters']);
						$title = $parameters['title_element'];
						unset($parameters['title_element']);
                        $this->data['products_design'][] = array(
                            'type' => $element['type'],
                            'title' => $title,
                            'value' => $element['value'],
                            'parameters' => http_build_query($parameters)
                        );
                    }
                }
            }
        $this->template = 'catalog/fnt_custom_design.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		$this->response->setOutput($this->render());
    }

    public function saveProductDesign()
    {
        $json = array();
        $this->load->language('catalog/fnt_custom_design');
        if (isset($this->request->get['product_design_id'])) {
            $this->load->model('catalog/fnt_product_design');
            if ($this->request->post) {
            $this->model_catalog_fnt_product_design->deleteProductDesignElement($this->request->get['product_design_element_id']);
                $product_design_element_id = $this->request->get['product_design_element_id'];
				for($i=0; $i < sizeof($this->request->post['element_types']); $i++) {

						$element = array();

						$element['type'] = $this->request->post['element_types'][$i];
						if ($element['type'] == 'image') {
							$element['source'] = str_replace(HTTP_CATALOG .'image/', '', $this->request->post['element_sources'][$i]);
						} else {
							$element['source'] = $this->request->post['element_sources'][$i];
						}

						$parameters = array();
						parse_str(html_entity_decode($this->request->post['element_parameters'][$i]), $parameters);
						if(is_array($parameters)) {
							foreach($parameters as $key => $value) {
								if($value == '') {
									$parameters[$key] = NULL;
								}
								else {
									$parameters[$key] = preg_replace('/\s+/', '', $value);
								}
							}
						}
						$parameters['title_element'] = $this->request->post['element_titles'][$i];
						$element['parameters'] = serialize($parameters);
						$this->model_catalog_fnt_product_design->addProductDesignElement($product_design_element_id, $element,$i);
					}
                $json['success'] = $this->language->get('text_success');
            }
        } elseif (isset($this->request->get['product_ideas_id'])) {
            $this->load->model('catalog/fnt_product_ideas');
            if ($this->request->post) {
            $this->model_catalog_fnt_product_ideas->deleteProductIdeasElement($this->request->get['product_ideas_element_id']);
                $index = 0;
                $product_ideas_element_id = $this->request->get['product_ideas_element_id'];
                for($i=0; $i < sizeof($this->request->post['element_types']); $i++) {

						$element = array();

						$element['type'] = $this->request->post['element_types'][$i];
						if ($element['type'] == 'image') {
							$element['source'] = str_replace(HTTP_CATALOG .'image/', '', $this->request->post['element_sources'][$i]);
						} else {
							$element['source'] = $this->request->post['element_sources'][$i];
						}

						$parameters = array();
						parse_str(html_entity_decode($this->request->post['element_parameters'][$i]), $parameters);
						if(is_array($parameters)) {
							foreach($parameters as $key => $value) {
								if($value == '') {
									$parameters[$key] = NULL;
								}
								else {
									$parameters[$key] = preg_replace('/\s+/', '', $value);
								}
							}
						}
						$parameters['title_element'] = $this->request->post['element_titles'][$i];
						$element['parameters'] = serialize($parameters);
						$this->model_catalog_fnt_product_ideas->addProductIdeasElement($product_ideas_element_id, $element,$i);
					}
                $json['success'] = $this->language->get('text_success');
            }
        }
        $this->response->setOutput(json_encode($json));
    }
	public function updateElement(){
		$this->load->model('catalog/fnt_product_ideas');
		$this->load->model('catalog/fnt_product_design');
		 $elements = $this->model_catalog_fnt_product_design->getProductDesignElementAll();
                if ($elements) {
                    foreach ($elements as $element) {
                        $parameters = unserialize($element['parameters']);
						if($parameters['title_element'] == 'Background'){
							$parameters['config_topped'] = 1;
							$this->model_catalog_fnt_product_design->editProductDesignElement($element['product_ideas_element_detail_id'],serialize($parameters));
						}
						
                    }
                }
	}
}