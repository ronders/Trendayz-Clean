<?php
class ControllerSaleFntOrderProductDesign extends Controller
{
    private $error = array();

    public function index()
    {
		if(isset($this->request->get['order_id']) && isset($this->request->get['order_product_id'])){
			$this->load->language('sale/fnt_order_product_design');
			$this->document->setTitle($this->language->get('heading_title'));
			//Include Css, jquery, google font
			$this->data['fonts'] = '';
			
			$this->document->addStyle('view/stylesheet/css_fancy/plugins.min.css');
			$this->document->addStyle('view/stylesheet/css_fancy/jquery.fancyProductDesigner.css');
			$this->document->addStyle('view/stylesheet/css_fancy/jquery.fancyProductDesigner-semantic.css');
			$this->document->addStyle('view/javascript/js_fancy/semantic/css/semantic.min.css');
			if (file_exists(DIR_CATALOG . 'view/theme/' . $this->config->get('config_template') . '/stylesheet/fancy_design/jquery.fancyProductDesigner-fonts.css')) {
				$this->document->addStyle(HTTP_CATALOG.'catalog/view/theme/'.$this->config->get('config_template').'/stylesheet/fancy_design/jquery.fancyProductDesigner-fonts.css');
			} else {
				$this->document->addStyle(HTTP_CATALOG.'catalog/view/theme/default/stylesheet/fancy_design/jquery.fancyProductDesigner-fonts.css');
			}
			$this->document->addScript('view/javascript/jquery/jquery-1.8.0.min.js');
			$this->document->addScript('view/javascript/jquery/superfish/js/superfish.js');
			$this->document->addScript('view/javascript/js_fancy/js/fabric.js');
			$this->document->addScript('view/javascript/js_fancy/jspdf/jspdf.min.js');
			$this->document->addScript('view/javascript/jquery/jquery.ui.widget.min.js');
			$this->document->addScript('view/javascript/jquery/jquery.ui.spinner.min.js');
			$this->document->addScript('view/javascript/js_fancy/js/plugins.min.js');
			$this->document->addScript('view/javascript/js_fancy/js/jquery.fancyProductDesigner.min.js');
			$this->document->addScript('view/javascript/js_fancy/js/webfont.js');
			$this->document->addScript('view/javascript/bootstrap/js/bootstrap.js');
			$this->document->addStyle('view/javascript/font-awesome/css/font-awesome.min.css');
			$this->document->addStyle('view/javascript/bootstrap/css/bootstrap.css');	
			$fonts_defaults = array();
			if($this->config->get('fonts_default')){
				$fonts_default = explode(',',$this->config->get('fonts_default'));
			} else {
				$fonts_default = array('Arial','Helvetica','Times New Roman','Verdana','Geneva');
			}
			if(!$fonts_default){
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
			//Get language
			$this->data['heading_title'] = $this->language->get('heading_title');
			$this->data['text_created_pdfs'] = $this->language->get('text_created_pdfs');
			$this->data['text_export'] = $this->language->get('text_export');
			$this->data['text_output_file'] = $this->language->get('text_output_file');
			$this->data['text_pdf'] = $this->language->get('text_pdf');
			$this->data['text_image'] = $this->language->get('text_image');
			$this->data['text_image_format'] = $this->language->get('text_image_format');
			$this->data['text_png'] = $this->language->get('text_png');
			$this->data['text_jpeg'] = $this->language->get('text_jpeg');
			$this->data['text_size'] = $this->language->get('text_size');
			$this->data['text_dpi_converter'] = $this->language->get('text_dpi_converter');
			$this->data['text_pdf_width_in_mm'] = $this->language->get('text_pdf_width_in_mm');
			$this->data['text_pdf_height_mm'] = $this->language->get('text_pdf_height_mm');
			$this->data['text_scale_factor'] = $this->language->get('text_scale_factor');
			$this->data['text_views'] = $this->language->get('text_views');
			$this->data['text_all'] = $this->language->get('text_all');
			$this->data['text_current_showing'] = $this->language->get('text_current_showing');
			$this->data['text_create'] = $this->language->get('text_create');
			$this->data['text_single_element_image'] = $this->language->get('text_single_element_image');
			$this->data['help_single'] = $this->language->get('help_single');
			$this->data['text_image_format'] = $this->language->get('text_image_format');
			$this->data['text_svg'] = $this->language->get('text_svg');
			$this->data['help_export_svg'] = $this->language->get('help_export_svg');
			$this->data['text_use_origin_size'] = $this->language->get('text_use_origin_size');
			$this->data['text_padding_element'] = $this->language->get('text_padding_element');
			$this->data['text_all_views'] = $this->language->get('text_all_views');
			$this->data['text_current_view'] = $this->language->get('text_current_view');
			$this->data['text_warning_create_image'] = $this->language->get('text_warning_create_image');
			$this->data['text_error_create_image'] = $this->language->get('text_error_create_image');
			$this->data['text_error_selected'] = $this->language->get('text_error_selected');
			$this->data['text_warning_popup_block'] = $this->language->get('text_warning_popup_block');
			$this->data['text_title_image'] = $this->language->get('text_title_image');
			$this->data['text_warning_set_width'] = $this->language->get('text_warning_set_width');
			$this->data['text_warning_message'] = $this->language->get('text_warning_message');
			$this->data['text_error_create_fancy'] = $this->language->get('text_error_create_fancy');
			$this->data['text_save_export_server'] = $this->language->get('text_save_export_server');
			$this->data['text_export_without_bounding'] = $this->language->get('text_export_without_bounding');
			if($this->config->get('config_text_patternable')){
				$this->data['patternable'] = 1;
				$this->data['patterns'] = $this->get_pattern_urls();
			} else {
				$this->data['patterns'] = array();
				$this->data['patternable'] = 0;
			}
			$this->data['images'] = array();
			$this->data['order_id'] = $this->request->get['order_id'];
			$this->data['token'] = $this->session->data['token'];
			$this->data['domain'] = HTTP_SERVER;
			$this->data['http_catalog'] = HTTP_CATALOG;
			$this->data['order_product_id'] = $this->request->get['order_product_id'];
			$this->load->model('sale/order');
			$product_design_info = $this->model_sale_order->getProductOrderDesign($this->request->get['order_id'], $this->request->get['order_product_id']);
			if($product_design_info){
				$this->data['config_stage_width'] = $product_design_info['stage_width'] ? $product_design_info['stage_width'] : 650;
				$this->data['config_stage_height'] = $product_design_info['stage_height'] ? $product_design_info['stage_height'] : 650;
				$this->data['design'] = html_entity_decode(base64_decode($product_design_info['design']), ENT_QUOTES, 'UTF-8');
				$this->data['design'] = str_replace('removable":false', 'removable":true', $this->data['design']);
			} else {
				$this->data['design'] = '';
			}
			
			$pic_types = array("jpg", "jpeg", "png", "svg");

			$dir = 'design_products_orders/images/' . $this->request->get['order_id'] . '/' . $this->request->get['order_product_id'] . '/';
			$item_dir = DIR_IMAGE . $dir;
			if(file_exists($item_dir)){
				$folder = opendir($item_dir);

				
				while ($file = readdir($folder) ) {
					if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$pic_types)) {
						$this->data['images'][] = array(
							'title'  => $file,
							'url'    => HTTP_CATALOG . 'image/' . $dir . $file
						);
					}
				}
				closedir($folder);
			}
			$this->template = 'sale/fnt_order_product_design.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);
			$this->response->setOutput($this->render());
		}	
    }
	private function get_pattern_urls() {
			$urls = array();
			$path = DIR_IMAGE . 'data/patterns/';
		  	$folder = opendir($path);
			$pic_types = array("jpg", "jpeg", "png");
			while ($file = readdir ($folder)) {
			  if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$pic_types)) {
				$urls[] = HTTP_CATALOG . 'image/data/patterns/' . $file;
			  }

			}
			closedir($folder);
			return $urls;
		}
		
		public function createImageByData() {
			if ( !isset($this->request->post['order_id']) || !isset($this->request->post['item_id']) || !isset($this->request->post['data_url']) || !isset($this->request->post['title']) )
			    exit;
			$json = array();
			$order_id = trim($this->request->post['order_id']);
			$item_id = trim($this->request->post['item_id']);
			$data_url = trim($this->request->post['data_url']);
			$title = trim($this->request->post['title']);

			//create fancy product orders directory
			if( !file_exists(DIR_IMAGE) )
				mkdir(DIR_IMAGE);

			//create uploads dir
			$images_dir = DIR_IMAGE . 'design_products_orders/';
		
			if( !file_exists($images_dir) )
				mkdir($images_dir);
			$images_dir = DIR_IMAGE . 'design_products_orders/images/';
		
			if( !file_exists($images_dir) )
				mkdir($images_dir);

			//create order dir
			$order_dir = $images_dir . $order_id . '/';
			if( !file_exists($order_dir) )
				mkdir($order_dir);

			//create item dir
			$item_dir = $order_dir . $item_id . '/';
			if( !file_exists($item_dir) )
				mkdir($item_dir);

			$png_path = $item_dir.$title.'.png';

			$image_exist = file_exists($png_path);
			//get the base-64 from data
			$base64_str = substr($data_url, strpos($data_url, ",")+1);
			//decode base64 string
			$decoded = base64_decode($base64_str);
			$result = file_put_contents($png_path, $decoded);
			$png_path = str_replace(DIR_IMAGE,HTTP_CATALOG . 'image/',$png_path);
			if($result){
				$json['code'] = $image_exist ? 302 : 201; 
				$json['url'] = $png_path;
				$json['title'] = $title;
				$this->response->setOutput(json_encode($json));
			}else {
				$json['code'] = 500;
				$json['url'] = $png_path;
				$json['title'] = $title;
				$this->response->setOutput(json_encode($json));
			}
			
		}
		
		public function createImageFromSvg() {
			if ( !isset($this->request->post['order_id']) || !isset($this->request->post['item_id']) || !isset($this->request->post['svg']) || !isset($this->request->post['title']) )
			    exit;
			require_once(DIR_SYSTEM.'library/svglib/svglib.php');
			$order_id = trim($this->request->post['order_id']);
			$item_id = trim($this->request->post['item_id']);
			$svg = stripslashes(trim($this->request->post['svg']));
			$width = trim($this->request->post['width']);
			$height = trim($this->request->post['height']);
			$title = trim($this->request->post['title']);

			//create fancy product orders directory
			if( !file_exists(DIR_IMAGE) )
				mkdir(DIR_IMAGE);

			//create uploads dir
			$images_dir = DIR_IMAGE . 'design_products_orders/';
		
			if( !file_exists($images_dir) )
				mkdir($images_dir);
			$images_dir = DIR_IMAGE . 'design_products_orders/images/';
		
			if( !file_exists($images_dir) )
				mkdir($images_dir);

			//create order dir
			$order_dir = $images_dir . $order_id . '/';
			if( !file_exists($order_dir) )
				mkdir($order_dir);

			//create item dir
			$item_dir = $order_dir . $item_id . '/';
			if( !file_exists($item_dir) )
				mkdir($item_dir);

			$image_path = $item_dir.$title.'.svg';

			$image_exist = file_exists($image_path);

			header('Content-Type: application/json');

			try {
				$svg = '<?xml version="1.0" encoding="UTF-8" standalone="no" ?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="'.$width.'" height="'.$height.'" xml:space="preserve">'.$svg.'</svg>';
				$svg_doc = new SVGDocument(html_entity_decode($svg, ENT_QUOTES, 'UTF-8'));
				$svg_doc->asXML($image_path);
				$image_url = str_replace(DIR_IMAGE,HTTP_CATALOG . 'image/',$image_path);
				$this->response->setOutput(json_encode(array('code' => $image_exist ? 302 : 201, 'url' => $image_url, 'title' => $title)));
			}
			catch(Exception $e) {
				$this->response->setOutput(json_encode(array('code' => 500)));
			}
		}
		public function createPdfFromDataUrl() {
			
			if( !class_exists('TCPDF') ) {
				require_once(DIR_SYSTEM.'library/tcpdf/tcpdf.php');
			}
			$order_id = trim($this->request->post['order_id']);
			$item_id = trim($this->request->post['item_id']);
			//if memory limit is too small, a fatal php error will thrown here
			$data_urls = $this->request->post['data_urls'];
			$width = trim($this->request->post['width']);
			$height = trim($this->request->post['height']);
			$image_format = trim($this->request->post['image_format']);
			$orientation = trim($this->request->post['orientation']);

			//create fancy product orders directory
			if( !file_exists(DIR_IMAGE . 'design_products_orders/') )
				mkdir(DIR_IMAGE . 'design_products_orders/');

			//create pdf dir
			$pdf_dir = DIR_IMAGE . 'design_products_orders/pdfs/';
			if( !file_exists($pdf_dir) )
				mkdir($pdf_dir);

			$pdf_path = $pdf_dir.$order_id.'-'.$item_id.'.pdf';
			$this->pdf = new TCPDF($orientation, 'mm', array($width, $height), true, 'UTF-8', false);
		
			// set document information
			$this->pdf->SetCreator(-1);
			$this->pdf->SetTitle($order_id);

			// remove default header/footer
			$this->pdf->setPrintHeader(false);
			$this->pdf->setPrintFooter(false);
			foreach($data_urls as $data_url) {
				$this->pdf->AddPage();
				
				if( $image_format == 'svg' ) {
					if( !class_exists('SVGDocument') )
						require_once(DIR_SYSTEM.'library/svglib/svglib.php');

					//$svg_doc = new SVGDocument($svg_data);
					//$svg_doc->asXML($svg_path);
					$this->pdf->ImageSVG('@'.$data_url);
				}
				else {
					$this->pdf->Image($data_url,0,0,0,0,$image_format);
				}
			}
			$this->pdf->Output($pdf_path, 'F');

			$pdf_url = str_replace(DIR_IMAGE,HTTP_CATALOG . 'image/',$pdf_path);
			$this->response->setOutput(json_encode( array('code' => 201, 'url' => $pdf_url)));
		}
		
		
}