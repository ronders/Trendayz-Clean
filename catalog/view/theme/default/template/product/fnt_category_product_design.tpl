<?php echo $header; ?>
<style>
	.fpd-navigation .fpd-nav-item{
		color:<?php echo $config_color_icon;?>
	}
	.fpd-menu-bar{
		color:<?php echo $config_color_icon;?>
	}
	.fpd-primary-bg-color{
		background-color:<?php echo $config_color_sidebar;?>
	}
	.fpd-navigation .active{
		color:<?php echo $config_color_sidebar;?>;
	}
	<?php if(isset($image_background)){ ?>
		.fpd-product-container > .fpd-product-stage{
			background-image:url(<?php echo $image_background;?>);
		}
	<?php }?>
	<?php if(isset($color_background)){ ?>
		.fpd-product-stage{
			background-color:<?php echo $color_background;?>;
		}
	<?php }?>
	<?php if($config_responsive){?>
		.fpd-sidebar{position:static !important;}
		.fpd-container .fpd-product-container{position:static !important;}
	<?php }?>
	<?php if($theme == 'icon-sb-left'){?>
		.fpd-product-container{left:<?php echo $config_sidebar_content_width + 10;?>px}
	<?php } elseif($theme == 'icon-sb-right'){?>
		.fpd-container{position:relative}
		.fpd-product-container{position:absolute;left:0;}
		.fpd-icon-sb-right .fpd-sidebar > div{float:none;}
		.fpd-icon-sb-right .fpd-product-container{margin:0;}
		.fpd-sidebar{position:absolute;right:-<?php echo $config_sidebar_content_width + 10;?>px}
	<?php }elseif($theme == 'icon-sb-top' || $theme == 'icon-sb-bottom'){?>
		.fpd-sidebar{position:static;margin-bottom:10px !important;}
		.fpd-navigation{margin-bottom:4px !important;}
		.fpd-product-container{position:static;}
		.fpd-sidebar > .fpd-navigation > .fpd-nav-item{width:25% !important;padding:0 !important}
		.fpd-nav-item{line-height:25px !important;}
		.fpd-navigation-product a, .fpd-navigation-upload .fpd-nav-item{padding: 0 !important;width: 50% !important;}
		.fpd-navigation-product{height:27px !important}
		div .fpd-navigation-product, div .fpd-navigation-upload{margin-top:0;}
		div .fpd-navigation-product, div .fpd-navigation-upload{height:26px;}
		.fpd-products .fpd-items-wrapper, .fpd-user-photos .fpd-items-wrapper{float: left;height: 222px;position: relative;width:100%;}
	<?php } elseif($theme == 'semantic'){?>			
		.fpd-sidebar, .fpd-product-container{position:static;}
		.fpd-sidebar .fpd-content{margin-top:10px;}
		#clothing-designer{margin:0 auto;}
	<?php }?>
</style>
<script type="text/javascript">
    jQuery(document).ready(function () {
	  var customImagesParams = jQuery.extend(
   	{
		"x":<?php echo $config_designs_parameter_x;?>,
		"y":<?php echo $config_designs_parameter_y;?>,
		"z":<?php echo $config_designs_parameter_z;?>,
		"price":<?php echo $config_designs_parameter_price;?>,
		"colors":"<?php echo $config_designs_parameter_colors;?>",
		"autoCenter":<?php echo $config_designs_parameter_auto_center;?>,
		"draggable":<?php echo $config_designs_parameter_draggable;?>,
		"rotatable":<?php echo $config_designs_parameter_rotatable;?>,
		"resizable":<?php echo $config_designs_parameter_resizable;?>,
		"zChangeable":<?php echo $config_designs_parameter_zchangeable;?>,
		"replace":'<?php echo $config_designs_parameter_replace;?>',
		"removable":<?php echo $config_designs_parameter_remove;?>,
		"autoSelect":<?php echo $config_designs_parameter_autoselect;?>,
		<?php if($config_designs_parameter_aboundingbox){?>
			"boundingBox":<?php echo $config_designs_parameter_aboundingbox;?>,
		<?php }?>	
		"boundingBoxClipping":<?php echo $config_designs_parameter_clipping;?>
	},
	{
   		minW: <?php echo $config_min_width;?>,
   		minH: <?php echo $config_min_height;?>,
   		maxW: <?php echo $config_max_width;?>,
   		maxH: <?php echo $config_max_height;?>,
   		resizeToW: <?php echo $config_resize_width;?>,
   		resizeToH: <?php echo $config_resize_height;?>							
   	}
   	);
   
   		//call fancy product designer plugin
   		 var yourDesigner = jQuery('#clothing-designer').fancyProductDesigner({
   			uploadDesigns: <?php echo $config_upload_designs;?>,
   			customTexts:  <?php echo $config_upload_text;?>,
			layout: "<?php echo $theme;?>",
			//layout: "icon-sb-bottom",
   			imageDownloadable: <?php echo $config_download_image;?>,
   			saveAsPdf: <?php echo $config_pdf_button;?>,
   			printable: <?php echo $config_print_button;?>,
   			allowProductSaving: <?php echo $config_allow_product_saving;?>,
   			resettable: <?php echo $config_reset_table;?>,
   			fontDropdown: <?php echo $config_font_dropdown;?>,
   			fonts: [<?php echo $fonts;?>],
   			templatesDirectory: "<?php echo $domain;?>index.php?route=fancy_design/",
   			phpDirectory: "<?php echo $domain;?>catalog/controller/product/fancy_design/",
			<?php if($config_facebook_app_id){?>
				facebookAppId: "<?php echo $config_facebook_app_id;?>",
			<?php }?>
			<?php if($config_instagram_client_id){?>
				instagramClientId: "<?php echo $config_instagram_client_id;?>",
			<?php }?>	
			<?php if($config_instagram_redirect_uri){?>
				instagramRedirectUri: "<?php echo $config_instagram_redirect_uri;?>",
			<?php }?>	
   			viewSelectionFloated: <?php echo $config_view_selection_float;?>,
   			zoomFactor: <?php echo $config_zoom;?>,
   			zoomRange: [<?php echo $config_zoom_min;?>, <?php echo $config_zoom_max;?>],
   			defaultText: "<?php echo $config_text_text_default;?>",
   			tooltips: <?php echo $config_view_tooltip;?>,
   			hexNames: {},
   			patterns: ["<?php echo implode('", "', $patterns); ?>"],
   			selectedColor:  "<?php echo $config_selected_color;?>",
   			boundingBoxColor:  "<?php echo $config_bounding_color;?>",
   			outOfBoundaryColor:  "<?php echo $config_out_boundary_color;?>",
   			elementParameters: {
   				originX: "center",
   				originY: "center"
   			},
   			customImagesParameters: customImagesParams,
   			customTextParameters: 
			{
				"x":<?php echo $config_text_x_position;?>,
				"y":<?php echo $config_text_y_position;?>,
				"z":<?php echo $config_text_z_position;?>,
				"colors":"<?php echo $config_text_design_color;?>",
				"price":<?php echo $config_text_design_price;?>,
				"autoCenter":<?php echo $config_text_auto_center;?>,
				"draggable":<?php echo $config_text_draggable;?>,
				"rotatable":<?php echo $config_text_rotatable;?>,
				"patternable":<?php echo $patternable;?>,
				"resizable":<?php echo $config_text_resizeable;?>,
				"zChangeable":<?php echo $config_text_zchangeable;?>,
				"autoSelect":<?php echo $config_text_autoselected;?>,
				"removable":<?php echo $config_text_remove;?>,
				"textSize":<?php echo $config_default_text_size;?>,
				"maxLength":<?php echo $config_text_text_characters;?>,
				"curvable":<?php echo $config_text_curved;?>,
				<?php if($config_designs_text_aboundingbox){?>
					"boundingBox":<?php echo $config_designs_text_aboundingbox;?>,
				<?php }?>	
				"boundingBoxClipping":<?php echo $config_designs_text_clipping;?>
			},
   			dimensions: {
				<?php if($theme == 'icon-sb-left' || $theme == 'icon-sb-right'){?>
					sidebarNavSize: <?php echo $config_sidebar_content_width;?>,
					sidebarSize: <?php echo $config_sidebar_height;?>,
				<?php } else {?>
					sidebarSize:<?php echo $config_stage_width;?>,
				<?php }?>
   				sidebarContentWidth: <?php echo $config_sidebar_content_width;?>,
   				productStageWidth: <?php echo $config_stage_width;?>,
   				productStageHeight: <?php echo $config_stage_height;?>
			},
   			labels: { //different labels used for the UI
   				outOfContainmentAlert: "<?php echo $text_out_of_containment;?>",
   				confirmProductDelete: "<?php echo $text_confirm_product_delete;?>",
   				colorpicker : {
   					cancel: "<?php echo $text_cancel;?>",
   					change: "<?php echo $text_change;?>"
   				},
   				uploadedDesignSizeAlert: "<?php echo $text_error_upload_size;?>",
   				initText: "<?php echo $text_init_text;?>",
   				myUploadedImgCat: "<?php echo $text_my_upload_image;?>"
   			},
   			sidebarLabels: { //all labels in the sidebar
   				designsMenu: "<?php echo $text_design_menu;?>",
   				editElementsMenu: "<?php echo $text_edit_element_menu;?>",
   				fbPhotosMenu: "<?php echo $text_fb_photo_menu;?>",
   				instaPhotosMenu: "<?php echo $text_insta_photo_menu;?>",
   				editElementsHeadline: "<?php echo $text_edit_element_headline;?>",
   				editElementsDropdownNone: "<?php echo $text_edit_element_dropdown_none;?>",
   				sectionFilling: "<?php echo $text_section_filling;?>",
   				sectionFontsStyles: "<?php echo $text_section_font_style;?>",
   				sectionCurvedText: "<?php echo $text_section_curved_text;?>",
   				sectionHelpers: "<?php echo $text_section_helpers;?>",
   				textAlignLeft: "<?php echo $text_align_left;?>",
   				textAlignCenter: "<?php echo $text_align_center;?>",
   				textAlignRight: "<?php echo $text_align_right;?>",
   				textBold: "<?php echo $text_bold;?>",
   				textItalic: "<?php echo $text_italic;?>",
   				curvedTextInfo: "<?php echo $text_curved_text_info;?>",
   				curvedTextSpacing: "<?php echo $text_curved_text_spacing;?>",
   				curvedTextRadius: "<?php echo $text_curved_text_radius;?>",
   				curvedTextReverse: "<?php echo $text_curved_text_reverse;?>",
   				curvedTextToggle: "<?php echo $text_text_toggle;?>",
   				centerH: "<?php echo $text_center_h;?>",
   				centerV: "<?php echo $text_center_v;?>",
   				moveDown: "<?php echo $text_move_down;?>",
   				moveUp: "<?php echo $text_move_up;?>",
   				reset: "<?php echo $text_reset;?>",
   				fbPhotosHeadline: "<?php echo $text_reset;?>",
   				fbSelectFriend: "<?php echo $text_fb_select_friend;?>",
   				fbSelectAlbum: "<?php echo $text_fb_select_album;?>",
   				instaPhotosHeadline: "<?php echo $text_insta_photo_headline;?>",
   				instaFeedButton: "<?php echo $text_insta_feed_button;?>",
   				instaRecentImagesButton: "<?php echo $text_insta_recent_image_button;?>",
   				instaLoadNext: "<?php echo $text_insta_load_next;?>"
   			},
   			productStageLabels: { //all labels in the product stage
   				addImageTooltip: "<?php echo $text_add_image_tooltip;?>",
   				addTextTooltip: "<?php echo $text_add_text_tooltip;?>",
   				zoomInTooltip: "<?php echo $text_zoom_in_tooltip;?>",
   				zoomOutTooltip: "<?php echo $text_zoom_out_tooltip;?>",
   				zoomResetTooltip: "<?php echo $text_zoom_reset_tooltip;?>",
   				downloadImageTooltip: "<?php echo $text_download_image_tooltip;?>",
   				printTooltip: "<?php echo $text_print_tooltip;?>",
   				pdfTooltip: "<?php echo $text_pdf_tooltip;?>",
   				saveProductTooltip: "<?php echo $text_save_product_tooltip;?>",
   				savedProductsTooltip: "<?php echo $text_save_products_tooltip;?>",
   				resetTooltip: "<?php echo $text_reset_tooltip;?>"
   			}
   		}).data('fancy-product-designer');
	var wcPrice = <?php echo $price;?>, currencyPrice = <?php echo $currency_value;?>,fntPrice = 0;
    //event handler when the price is changing
    $('#clothing-designer').bind('priceChange', function (evt, price, currentPrice) {
		fntPrice = currentPrice;
		_setTotalPrice();
    });
	//Get options and price for product 
	var product_design_active = 0;
	$('.fpd-products picture').live('click', function(){
		if($(this).index() != product_design_active){
			var product_design_id = $(this).attr('class');
			$('.breadcrumb h1').html($(this).find('img').attr('title'));
			
			$.ajax({
				url: 'index.php?route=product/fnt_category_product_design/loadProductDetail&product_design_id=' + product_design_id,
                type: 'post',
                dataType: 'json',
                success: function (json) {
					if (json['option']) {
						$('#product .options').html(json['option']);
						if ($.browser.msie && $.browser.version == 6) {
							$('.date, .datetime, .time').bgIframe();
						}
						$('.date').datepicker({dateFormat: 'yy-mm-dd'});
						$('.datetime').datetimepicker({
							dateFormat: 'yy-mm-dd',
							timeFormat: 'h:m'
						});
						$('.time').timepicker({timeFormat: 'h:m'});
					}
					$('input[name="product_design_id"]').val(json['product_design_id']);
					$('input[name="product_id"]').val(json['product_id']);
					$('input[name="quantity"]').val(json['minimum']);
					wcPrice = parseFloat(json['price_product']);
					
					_setTotalPrice();
                }
            });	
			product_design_active = $(this).index();
			product_design_id_active = $(this).attr('class');
		}
	});
	//Get product info and options for product saved
		$('.fpd-saved-products img').live('click', function(){
		
			var info_save = $(this).attr('data-parameter');
			if(info_save){
				info_save = info_save.split(":");
			}
			$('.breadcrumb h1').html($(this).attr('title'));
			$.ajax({
				url: 'index.php?route=product/fnt_category_product_design/loadProductDetail&product_design_id=' + info_save[0],
                type: 'post',
                dataType: 'json',
                success: function (json) {
					if (json['option']) {
						$('#product .options').html(json['option']);
						if ($.browser.msie && $.browser.version == 6) {
							$('.date, .datetime, .time').bgIframe();
						}
						$('.date').datepicker({dateFormat: 'yy-mm-dd'});
						$('.datetime').datetimepicker({
							dateFormat: 'yy-mm-dd',
							timeFormat: 'h:m'
						});
						$('.time').timepicker({timeFormat: 'h:m'});
					}
					$('input[name="product_design_id"]').val(json['product_design_id']);
					$('input[name="product_id"]').val(json['product_id']);
					$('input[name="quantity"]').val(json['minimum']);
					product_design_active = -1;
					product_design_id_active = info_save[0];
					$('#thsirt-price').text((parseFloat(info_save[1])*parseFloat(currencyPrice)).toFixed(<?php echo $decimal_place;?>));
					$('input[name="product_price"]').val(info_save[1]);
					wcPrice = parseFloat(json['price_product']);
                }
            });	
		});
	$('#clothing-designer').on('productCreate', function() {
		productCreated = true;
		_setTotalPrice();
		<?php if($theme == 'icon-sb-left' || $theme == 'icon-sb-right'){?>
			$('.fpd-sidebar').height($('.fpd-product-container').height());
		<?php }?>	
	});
	function _setTotalPrice() {
		 $('#thsirt-price').text((parseFloat(fntPrice*currencyPrice)+parseFloat(wcPrice*currencyPrice)).toFixed(<?php echo $decimal_place;?>));
		  $('input[name="product_price"]').val((fntPrice)+parseFloat(wcPrice));
	}
	 $('#clothing-designer').on('ready', function() {
	   <?php if(isset($design)){?>
		   views = <?php echo $design;?>;
		//   yourDesigner.addProduct(views);
		   yourDesigner.clear();
		   yourDesigner.loadProduct(views);
	   <?php }?>
	 });
    //send image via mail
    $('#send-image-mail-php').click(function () {
        $.post("php/send_image_via_mail.php", { base64_image: yourDesigner.getProductDataURL()});
    });
	 $('#button-cart').on('click', function () { 
		if(!productCreated) { return false; }
            var product = yourDesigner.getProduct();
            if (product != false) {
                $('input[name="fpd_product"]').val(JSON.stringify(product));
				_setTotalPrice();
				//Add thumbnail for product design when add to cart
				thumbnail = yourDesigner.getViewsDataURL('png', 'transparent', 0.2)[0];
                $('input[name="fpd_thumbnail"]').val(thumbnail);
				$.ajax({
					url: 'index.php?route=checkout/cart/addDesign',
					type: 'post',
					data: $('#product input[type=\'text\'], #product input[type=\'date\'], #product input[type=\'datetime-local\'], #product input[type=\'time\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
					dataType: 'json',
					success: function (json) {
						$('.alert, .text-danger').remove();

						if (json['error']) {
							if (json['error']['option']) {
								for (i in json['error']['option']) {
									alert(json['error']['option'][i]);
								}
							}
						}
						if (json['success']) {
							$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
								
							$('.success').fadeIn('slow');
								
							$('#cart-total').html(json['total']);
							
							$('html, body').animate({ scrollTop: 0 }, 'slow'); 
						}
					}
				});	
            }
        });
		
		//Save product design ideas by admin
		<?php if(isset($user_id)){?>
			$('#button-save-admin').on('click', function () { 
				if(!productCreated) { return false; }
			   base64_image = yourDesigner.getProduct();
			   if(base64_image != false){
				   $.post("index.php?route=product/fnt_category_product_design/editDesignCustomerAprroved&product_customer_idea_accept_id=<?php echo $product_customer_idea_accept_id;?>", { base64_image: JSON.stringify(base64_image)},function(data){
					if(data){
						$('.success').remove();
						$('.box-user-admin').before('<p class="success">' + data['success'] + '</p>');
					}
				   },'json');
				} 
			});
		<?php }?>
		var product_design_id_active = <?php echo $product_design_id;?>;
		//save link design 
	   $('#button-share-design').live('click', function(){
		   if(!productCreated) { return false; }
		   base64_image = yourDesigner.getProduct();
		   if(base64_image != false){
			   $.post("index.php?route=product/fnt_category_product_design/saveDesignCustomer&product_design_id=" + product_design_id_active, { base64_image: JSON.stringify(base64_image)},function(data){
				if(data){
					$('.link-share').remove();
							$('.box-share').append('<textarea style="width:97%;height:65px" selected="selected" class="link-share">' + data['success'] + '</textarea>');
							$('.link-share').focus();
							$('.link-share').select();
				}
			   },'json');
			} 
		   });	
		   //save design to account customer
		  $('.login_popup').click(function () {
			if(!productCreated) { return false; }
			base64_image = yourDesigner.getProduct();
			if(base64_image != false){
				$.post("index.php?route=product/fnt_category_product_design/saveProductDesignSession&product_design_id=" + product_design_id_active, { base64_image: JSON.stringify(base64_image)});
			}
		 });
		   
		   //share facebook image
		$('#button-share-fb').click(function(){
		   $.post( "index.php?route=product/fnt_category_product_design/creatImageShare", { base64_image: yourDesigner.getProductDataURL()},function(data){
			if(data){
				window.open('https://www.facebook.com/share.php?u=' + data['url']+'&title=<?php echo $heading_title;?>');
			}
		   },'json');
		   return false;
		});
		
		$('.popup-content').perfectScrollbar();
		$('#show-popup').click(function(){
		if(!productCreated) { return false; }
            var product = yourDesigner.getProduct();
            if (product != false) {
				var base64_image = yourDesigner.getProductDataURL();
				$.ajax({
					url: 'index.php?route=product/fnt_category_product_design/validateOption',
					type: 'post',
					data: $('#product input[type=\'text\'], #product input[type=\'date\'], #product input[type=\'datetime-local\'], #product input[type=\'time\'], #product input[type=\'hidden\'], #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea'),
					dataType: 'json',
					success: function (json) {
						$('.alert, .text-danger').remove();

						if (json['error']) {
							if (json['error']['option']) {
								for (i in json['error']['option']) {
									alert(json['error']['option'][i]);
								}
							}
						} else {
							$('#light img').attr('src',base64_image);
							var msgbox = $('#light');
							var x = (window.innerWidth / 2) - ($('#light').offsetWidth / 2);
							var y = (window.offsetHeight / 2) - ($('#light').offsetHeight / 2);
							$('#light').css({top: y, left: x});			  
							$('#light').css('display','block');
							$('#fade').css('display','block');
							$(window).scrollTop(0);
							$('html').css('overflow-y','hidden');
						}
					}
				});
			}	
		});
		$(document).on('change', 'input[name=\'accept_design\']', function(){
			if($(this).is(':checked')){
				$('#add-to-cart-popup').removeAttr('disabled', 'disabled'); 
				$('#add-to-cart-popup').addClass('button_active'); 
			} else {
				$('#add-to-cart-popup').attr('disabled','disabled');
				$('#add-to-cart-popup').removeClass('button_active'); 
			}
		});
		$('#close-popup').click(function(){
			$('#add-to-cart-popup').attr('disabled','disabled');
			$('#add-to-cart-popup').removeClass('button_active'); 
			$('input[name=\'accept_design\']').attr('checked', false); 
			$('#light').css('display','none');
			$('#fade').css('display','none');
			$('html').css('overflow-y','auto');
		});
	   $('#add-to-cart-popup').click(function(){
			$('#add-to-cart-popup').attr('disabled','disabled');
			$('#add-to-cart-popup').removeClass('button_active'); 
			$('input[name=\'accept_design\']').attr('checked', false); 
			$('#button-cart').click();
			$('#light').css('display','none');
			$('#fade').css('display','none');
			$('html').css('overflow-y','auto');
		});
	});	
</script>
<div class="container">
<div class="breadcrumb">
    <h1 style="text-align: center;"><?php echo $heading_title;?></h1>
  </div>
  <?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
<div id="clothing-designer" <?php echo ($config_responsive) ? '' : 'style="max-width:'.$config_stage_max_width.'px"';?>>
    <?php if($products_design){?>
		<?php foreach($products_design as $product_idea){?>
			<div class="fpd-product" data-parameters="<?php echo $product_idea['product_design_id'];?>" title="<?php echo $product_idea['name'];?>" data-thumbnail="<?php echo $product_idea['image'];?>">
			<?php if(isset($product_idea['first_element']['children']) && $product_idea['first_element']['children']){?>
				<?php foreach($product_idea['first_element']['children'] as $children){?>
					<?php if($children['type'] == 'image'){?>
						<img src="<?php echo $children['value'];?>" title="<?php echo $children['title'];?>" data-parameters='<?php echo $children['parameters'];?>' />
					<?php } else {?>
						<span title="<?php echo $children['title'];?>" data-parameters='<?php echo $children['parameters'];?>' ><?php echo $children['value'];?></span>
					<?php }?>
				<?php }?>
			<?php }?>
			<?php if($product_idea['children']){?>
				<?php foreach($product_idea['children'] as $children){?>
					<div class="fpd-product" title="<?php echo $children['name'];?>" data-thumbnail="<?php echo $children['image'];?>">
					<?php if($children['children']){?>
						<?php foreach($children['children'] as $child){?>
							<?php if($child['type'] == 'image'){?>
								<img src="<?php echo $child['value'];?>" title="<?php echo $child['title'];?>" data-parameters='<?php echo $child['parameters'];?>' />
							<?php } else {?>
								<span title="<?php echo $child['title'];?>" data-parameters='<?php echo $child['parameters'];?>' ><?php echo $child['value'];?></span>
							<?php }?>
						<?php }?>
					<?php }?>
					</div>
				<?php }?>
			<?php } ?>
			</div>
		<?php }?>
    <?php }?>
	 <?php if($product_ideas){?>
		<?php foreach($product_ideas as $product_idea){?>
			<div class="<?php echo $group_class;?>" data-parameters="<?php echo $product_idea['product_design_id'];?>" title="<?php echo $product_idea['name'];?>" data-thumbnail="<?php echo $product_idea['image'];?>">
			<?php if(isset($product_idea['first_element']['children']) && $product_idea['first_element']['children']){?>
				<?php foreach($product_idea['first_element']['children'] as $children){?>
					<?php if($children['type'] == 'image'){?>
						<img src="<?php echo $children['value'];?>" title="<?php echo $children['title'];?>" data-parameters='<?php echo $children['parameters'];?>' />
					<?php } else {?>
						<span title="<?php echo $children['title'];?>" data-parameters='<?php echo $children['parameters'];?>' ><?php echo $children['value'];?></span>
					<?php }?>
				<?php }?>
			<?php }?>
			<?php if($product_idea['children']){?>
				<?php foreach($product_idea['children'] as $children){?>
					<div class="<?php echo $group_class;?>" title="<?php echo $children['name'];?>" data-thumbnail="<?php echo $children['image'];?>">
					<?php if($children['children']){?>
						<?php foreach($children['children'] as $child){?>
							<?php if($child['type'] == 'image'){?>
								<img src="<?php echo $child['value'];?>" title="<?php echo $child['title'];?>" data-parameters='<?php echo $child['parameters'];?>' />
							<?php } else {?>
								<span title="<?php echo $child['title'];?>" data-parameters='<?php echo $child['parameters'];?>' ><?php echo $child['value'];?></span>
							<?php }?>
						<?php }?>
					<?php }?>
					</div>
				<?php }?>
			<?php } ?>
			</div>
		<?php }?>
    <?php }?>
    <?php if($cliparts && !$hide_designs_tab){?>
		<div class="fpd-design">
			<?php foreach($cliparts as $key => $clipart){?>
			<?php if($clipart['children']){?>
			 <div class="fpd-category" title="<?php echo $clipart['name'];?>" id="<?php echo $clipart['category_clipart_id'];?>">
			<?php foreach($clipart['children'] as $child){?>
			<img src="<?php echo $child['image'];?>" title="<?php echo $child['name'];?>" data-parameters='<?php echo $child['parameters'];?>' />
			<?php }?>
			</div>
			<?php }?>
			<?php }?>
		</div>
    <?php }?>
</div>
<br/>
<div class="product-design-info">
	<?php if(isset($user_id)){?>
		<div class="box-user-admin">
			<h3 class="price"><?php echo $curency_code_left;?><span id="thsirt-price"></span> <?php echo $curency_code_right;?></h3>
			<input type="button" value="<?php echo $text_save_design;?>" class="button" id="button-save-admin" />
		</div>	
	<?php } else {?>
		 <div class="box-share">
				<a id="button-share-design" title="<?php echo $text_share_design;?>" class="button fpd-tooltip"> <i class="fa fa-share icon"></i> <?php echo $text_share_design;?></a>
				<a id ="button-share-fb" class="button fpd-tooltip" title="<?php echo $text_share_image;?>"><i class="fa fa-facebook icon"></i> <?php echo $text_share_image;?></a>
				<span class="login_popup"> <a class="button fpd-tooltip" title="<?php echo $text_save_design;?>" href="<?php echo $link_save;?>"><i class="fa fa-save icon" ></i> <?php echo $text_save_design;?></a></span>
			 </div>
		<div id="product" class="right">
			<div class="cart form-group">
			 <input type="hidden" value="" name="fpd_product"/>
			 <input type="hidden" value="" name="fpd_thumbnail"/>
				<input type="hidden" value="" name="product_price"/>
				<input type="hidden" value="<?php echo $price;?>" name="product_price_base"/>
				<input type="hidden" value="<?php echo $currency;?>" name="currency"/>
				<input type="hidden" id="product_design_id" value="<?php echo $product_design_id;?>" name="product_design_id"/>
			<div>
			<div class="options"> 
				<?php foreach ($options as $option) { ?>
				<?php if ($option['type'] == 'select') { ?>
				<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
				  <?php if ($option['required']) { ?>
				  <span class="required">*</span>
				  <?php } ?>
				  <b><?php echo $option['name']; ?>:</b><br>
				  <select name="option[<?php echo $option['product_option_id']; ?>]">
					<option value=""><?php echo $text_select; ?></option>
					<?php foreach ($option['option_value'] as $option_value) { ?>
					<option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
					<?php if ($option_value['price']) { ?>
					(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
					<?php } ?>
					</option>
					<?php } ?>
				  </select>
				</div>
			  
				<?php } ?>
				<?php if ($option['type'] == 'radio') { ?>
				<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
				  <?php if ($option['required']) { ?>
				  <span class="required">*</span>
				  <?php } ?>
				  <b><?php echo $option['name']; ?>:</b><br>
				  <?php foreach ($option['option_value'] as $option_value) { ?>
				  <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
				  <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
					<?php if ($option_value['price']) { ?>
					(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
					<?php } ?>
				  </label>
				  <br />
				  <?php } ?>
				</div>
			   
				<?php } ?>
				<?php if ($option['type'] == 'checkbox') { ?>
				<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
				  <?php if ($option['required']) { ?>
				  <span class="required">*</span>
				  <?php } ?>
				  <b><?php echo $option['name']; ?>:</b><br>
				  <?php foreach ($option['option_value'] as $option_value) { ?>
				  <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
				  <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
					<?php if ($option_value['price']) { ?>
					(<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
					<?php } ?>
				  </label>
				  <br />
				  <?php } ?>
				</div>
			  
				<?php } ?>
				<?php if ($option['type'] == 'image') { ?>
				<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
				  <?php if ($option['required']) { ?>
				  <span class="required">*</span>
				  <?php } ?>
				  <b><?php echo $option['name']; ?>:</b><br>
				  <table class="option-image">
					<?php foreach ($option['option_value'] as $option_value) { ?>
					<tr>
					  <td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
					  <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
					  <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
						  <?php if ($option_value['price']) { ?>
						  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
						  <?php } ?>
						</label></td>
					</tr>
					<?php } ?>
				  </table>
				</div>
			   
				<?php } ?>
				<?php if ($option['type'] == 'text') { ?>
				<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
				  <?php if ($option['required']) { ?>
				  <span class="required">*</span>
				  <?php } ?>
				  <b><?php echo $option['name']; ?>:</b><br>
				  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
				</div>
			  
				<?php } ?>
				<?php if ($option['type'] == 'textarea') { ?>
				<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
				  <?php if ($option['required']) { ?>
				  <span class="required">*</span>
				  <?php } ?>
				  <b><?php echo $option['name']; ?>:</b><br>
				  <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="30" rows="3"><?php echo $option['option_value']; ?></textarea>
				</div>
			  
				<?php } ?>
				<?php if ($option['type'] == 'file') { ?>
				<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
				  <?php if ($option['required']) { ?>
				  <span class="required">*</span>
				  <?php } ?>
				  <b><?php echo $option['name']; ?>:</b><br>
				  <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="upload">
				  <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
				</div>
			  
				<?php } ?>
				<?php if ($option['type'] == 'date') { ?>
				<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
				  <?php if ($option['required']) { ?>
				  <span class="required">*</span>
				  <?php } ?>
				  <b><?php echo $option['name']; ?>:</b><br>
				  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
				</div>
			  
				<?php } ?>
				<?php if ($option['type'] == 'datetime') { ?>
				<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
				  <?php if ($option['required']) { ?>
				  <span class="required">*</span>
				  <?php } ?>
				  <b><?php echo $option['name']; ?>:</b><br>
				  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
				</div>
			  
				<?php } ?>
				<?php if ($option['type'] == 'time') { ?>
				<div id="option-<?php echo $option['product_option_id']; ?>" class="option">
				  <?php if ($option['required']) { ?>
				  <span class="required">*</span>
				  <?php } ?>
				  <b><?php echo $option['name']; ?>:</b><br>
				  <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
				</div>
				<?php } ?>
				<?php } ?>
			 </div> 	
				<h3 class="price"><?php echo $curency_code_left;?><span id="thsirt-price"></span> <?php echo $curency_code_right;?></h3>
				<div class="qty">                  
					<strong><?php echo $entry_qty;?>: </strong>
					<input id="qty" type="text" class="w30" name="quantity" size="2" value="<?php echo (isset($minimum)) ? $minimum : 0 ;?>" />        
					<input type="hidden" id="product_id" name="product_id" size="2" value="<?php echo $product_id;?>" />
					<div class="clear"></div>
				</div>
				<?php if(!$config_show_popup_view){?>
					<input type="button" value="<?php echo $text_order;?>" class="button" id="button-cart" />
				<?php } else {?>
				<input type="button" style="display:none;" value="<?php echo $text_order;?>" class="button" id="button-cart" />
				<input type="button" value="<?php echo $text_order;?>" class="button" id="show-popup" />
			 <?php }?>	
			</div>
			
		  </div>
		</div>
	<?php }?>
	
</div>
<?php echo $content_bottom; ?></div>
</div>
<div id="light" class="popup-box"> 
	<div class="popup-content ps-container" style="width:<?php echo $config_stage_width;?>px">
		<div>
			<p class="information-popup"><input type="checkbox" name="accept_design" /> <?php echo $text_confirm_design;?></p>
			<p class="button-popup">
				<input type="button" disabled="disabled" value="Add to cart" class="button" id="add-to-cart-popup" />
				<input type="button" value="Continue design" class="button" id="close-popup" />	
			</p>
		</div>	
		<img src="" />
	</div>	
</div>
<div id="fade" class="black_overlay"></div>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php if ($options) { ?>
	<?php foreach ($options as $option) { ?>
		<?php if ($option['type'] == 'file') { ?>
			<script type="text/javascript"><!--
				new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
					action: 'index.php?route=product/product/upload',
					name: 'file',
					autoSubmit: true,
					responseType: 'json',
					onSubmit: function(file, extension) {
						$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
						$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
					},
					onComplete: function(file, json) {
						$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
						
						$('.error').remove();
						
						if (json['success']) {
							alert(json['success']);
							
							$('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
						}
						
						if (json['error']) {
							$('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
						}
						
						$('.loading').remove();	
					}
				});
			//--></script>
		<?php } ?>
	<?php } ?>
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}

	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	$('.datetime').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'h:m'
	});
	$('.time').timepicker({timeFormat: 'h:m'});
});
//--></script> 
<?php echo $footer; ?>