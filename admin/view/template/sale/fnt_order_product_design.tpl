<?php echo $header;?>
<div id="content">
<div class="container-fluid">				
			  <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title;?> - OrderID: #<?php echo $order_id;?></h3>
				</div>
				<div class="panel-body">
  <div class="postbox " id="fpd-order">
<div class="inside">
<div id="fpd-order-panel">
	<div id="fpd-order-designer-wrapper">
		<!-- Product Designer Container -->
		<div id="fpd-order-designer"></div>

		<!-- Tools -->
		<div id="fpd-export-tools" class="ui form green segment">

			<div class="two fields">

				<div class="field">
					<h2> <?php echo $text_export;?></h2>
					<div class="inline fields">
						<div class="field three wide">
							<?php echo $text_output_file;?>
						</div>
						<div class="field nine wide">
							<label><input type="radio" name="fpd_output_file" value="pdf" checked="checked" /> <?php echo $text_pdf;?></label>
							<label><input type="radio" name="fpd_output_file" value="image" /> <?php echo $text_image;?></label>
						</div>
					</div>
					<div class="inline fields">
						<div class="field three wide">
							<?php echo $text_image_format;?>
						</div>
						<div class="field nine wide">
							<label><input type="radio" name="fpd_image_format" value="png" checked="checked" /> <?php echo $text_png;?></label>
							<label><input type="radio" name="fpd_image_format" value="jpeg" /> <?php echo $text_jpeg;?></label>
							<!-- <input type="radio" name="fpd_image_format" value="svg" /> -->
						</div>
					</div>
					<div class="inline fields">
						<div class="field three wide">
							<p><?php echo $text_size;?></p>
							<div><a href="http://www.hdri.at/dpirechner/dpirechner_en.htm" target="_blank" style="font-size: 11px;"><?php echo $text_dpi_converter;?></a></div>
						</div>
						<div class="field three wide">
							<label><input type="number" value="210" id="fpd-pdf-width" /> <?php echo $text_pdf_width_in_mm;?></label>
						</div>
						<div class="field three wide">
							<label><input type="number" value="297" id="fpd-pdf-height" /> <?php echo $text_pdf_height_mm;?></label>
						</div>
						<div class="field three wide">
							<label><input type="text" value="" name="fpd_scale" placeholder="1" /><?php echo $text_scale_factor;?></label>
						</div>
					</div>
					<div class="inline fields">
						<div class="field three wide">
							<?php echo $text_views;?>
						</div>
						<div class="field nine wide">
							<label><input type="radio" name="fpd_export_views" value="all" checked="checked" /> <?php echo $text_all;?></label>
							<label><input type="radio" name="fpd_export_views" value="current" /> <?php echo $text_current_showing;?></label>
						</div>
					</div>
					<button id="fpd-generate-file" class="btn btn-primary button button-primary"><?php echo $text_create;?></button>
					<img class="help_tip" data-toggle="tooltip" title = "<?php echo $text_created_pdfs . $http_catalog . 'image/design_products_orders/pdfs'; ?>" src="view/image/help.png" height="16" width="16" />
				</div>

				<div class="field">
					<h2><?php echo $text_single_element_image;?><img class="help_tip" data-toggle="tooltip" title="<?php echo $help_single . $http_catalog . 'image/design_products_orders/images'?>" src="view/image/help.png" height="16" width="16" /></h2>
					<div class="inline fields">
						<div class="field three wide">
							<?php echo $text_image_format;?>
						</div>
						<div class="field nine wide">
							<label><input type="radio" name="fpd_single_image_format" value="png" checked="checked" /> <?php echo $text_png;?></label>
							<label><input type="radio" name="fpd_single_image_format" value="jpeg" /> <?php echo $text_jpeg;?></label>
							<label><input type="radio" name="fpd_single_image_format" value="svg" /> <?php echo $text_svg;?><img class="help_tip" data-toggle="tooltip" title="<?php echo $help_export_svg;?>" src="view/image/help.png" height="16" width="16" /></label>
						</div>
					</div>
					<div class="inline fields">
						<div class="field">
							<label>
								<input type="checkbox" id="fpd-restore-oring-size" />
								<?php echo $text_use_origin_size;?>
							</label>
						</div>
					</div>
					<div class="inline fields">
						<div class="field">
							<label>
								<input type="checkbox" id="fpd-save-on-server" />
								<?php echo $text_save_export_server;?>
							</label>
						</div>
					</div>
					<div class="inline fields">
						<div class="field">
							<label>
								<input type="checkbox" id="fpd-without-bounding-box" />
								<?php echo $text_export_without_bounding;?>
							</label>
						</div>
					</div>
					<div class="inline fields">
						<div class="field">
							<label>
								<input type="number" min="0" value="" name="fpd_single_element_padding" placeholder="0" />
								<?php echo $text_padding_element;?>
							</label>
						</div>
					</div>
					<button id="fpd-save-element-as-image" class="btn btn-primary button button-primary"><?php echo $text_create;?></button>
					<ul id="fnt-order-image-list">
						<?php if($images){?>
							<?php foreach($images as $image){?>
								<li>
									<a target="_blank" href="<?php echo $image['url'];?>" title="<?php echo $image['url'];?>"><?php echo $image['title'];?></a>
								</li>
							<?php }?>
						<?php }?>
						</ul>
				</div>

			</div>

		</div><!-- Tools -->

	</div>
</div><script type="text/javascript">

	jQuery(document).ready(function($) {

		var $fancyProductDesigner = $('#fpd-order-designer'),
			isReady = false,
			stageWidth = <?php echo $config_stage_width;?>,
			stageHeight = <?php echo $config_stage_height;?>;

		var fancyProductDesigner = $fancyProductDesigner.fancyProductDesigner({
			editorMode: true,
			fonts: [<?php echo $fonts;?>],
			templatesDirectory: "<?php echo $domain;?>index.php?route=fancy_design/",
			patterns: ["<?php echo implode('", "', $patterns); ?>"],
			token: "<?php echo $token;?>",
			layout: 'semantic',
			tooltips: false,
			dimensions: {
				productStageWidth: <?php echo $config_stage_width;?>,
				productStageHeight: <?php echo $config_stage_height;?>
			}
		}).data('fancy-product-designer');
		$fancyProductDesigner.on('ready', function() {
			isReady = true;
			
		   fancyProductDesigner.loadProduct(<?php echo $design;?>);
		});
		
			$('[name="fpd_output_file"]').change(function() {

			if($('[name="fpd_output_file"]:checked').val() == 'pdf') {
				$('#fpd-pdf-width').parents('.field:first').show();
				$('#fpd-pdf-height').parents('.field:first').show();
			}
			else {
				$('#fpd-pdf-width').parents('.field:first').hide();
				$('#fpd-pdf-height').parents('.field:first').hide();
			}

		}).change();

		$('[name="fpd_image_format"]').change(function() {

			if($('[name="fpd_image_format"]:checked').val() == 'svg') {
				$('#fpd-size-fields').hide();
			}
			else {
				$('#fpd-size-fields').show();
			}

		}).change();

		$('#fpd-generate-file').click(function(evt) {

			evt.preventDefault();

			if(_checkAPI()) {

				if($('[name="fpd_output_file"]:checked').val() == 'image') {
					createImage();
				}
				else {
					createPdf();
				}

			}

		});

		$('#fpd-save-element-as-image').click(function(evt) {

			evt.preventDefault();

			if(_checkAPI()) {

				var stage = fancyProductDesigner.getStage(),
					format = $('input[name="fpd_single_image_format"]:checked').val(),
					backgroundColor = format == 'jpeg' ? '#ffffff' : 'transparent',
					currentViewIndex = fancyProductDesigner.getViewIndex(),
					objects = stage.getObjects();

				if(stage.getActiveObject()) {

					var $this = $(this),
						element = stage.getActiveObject(),
						dataObj;

					if(format == 'svg') {

						if(element.toSVG().search('<image') != -1) {
							alert("<?php echo $text_warning_create_image;?>");
							return false;
						}

					}

					fancyProductDesigner.deselectElement();

					//check if origin size should be rendered
					if($('#fpd-restore-oring-size').is(':checked')) {
						element.setScaleX(1);
						element.setScaleY(1);
					}

					stage.setBackgroundColor(backgroundColor, function() {

						var paddingTemp = element.padding;
						element.padding = $('input[name="fpd_single_element_padding"]').val().length == 0 ? 0 : Number($('input[name="fpd_single_element_padding"]').val());

						var clipToTemp = element.getClipTo();
						if(clipToTemp != null) {

							if($('#fpd-without-bounding-box').is(':checked')) {
								element.setClipTo(null);
								stage.renderAll();
							}
							else {
								for(var i=0; i < objects.length; ++i) {

								var object = objects[i];
								if(object.viewIndex == currentViewIndex) {
									object.visible = false;
								}

							}

								element.visible = true;
							}

							/*stage.setDimensions({width: clippingArea.width + clippingArea.width - element.getBoundingRect().left, height: clippingArea.top + clippingArea.height - element.getBoundingRect().top}).renderAll();
							element.setLeft(element.left - clippingArea.left).setTop(element.top - clippingArea.top)
							.center()
							.setCoords();*/

						}

						element.setCoords();

						var source;

						if(format == 'svg') {
							source = element.toSVG();
						}
						else {
							source = clipToTemp != null && !$('#fpd-without-bounding-box').is(':checked') ? stage.toDataURL({format: format}) : element.toDataURL({format: format});
						}

						if($('#fpd-save-on-server').is(':checked')) {

							$('#fpd-export-tools').addClass('loading');

						if(format == 'svg') {
							url = "index.php?route=sale/fnt_order_product_design/createImageFromSvg&token=<?php echo $token;?>";
							dataObj = {
								order_id: <?php echo $order_id; ?>,
								item_id: <?php echo $order_product_id;?>,
								svg: source,
								width: stage.getWidth(),
								height: stage.getHeight(),
								title: element.title
							};

						}
						else {
							url = "index.php?route=sale/fnt_order_product_design/createImageByData&token=<?php echo $token;?>";
							dataObj = {
								order_id: <?php echo $order_id; ?>,
								item_id: <?php echo $order_product_id;?>,
								data_url: source,
								title: element.title,
								format: format
							};
						}

						$.ajax({
							url: url,
							data: dataObj,
							type: 'post',
							dataType: 'json',
							success: function(json) {
								if(json['code'] == 500) {
									alert("<?php echo $text_error_create_image;?>");
								}
								else if( json['code'] == 201 ) {
									$('#fnt-order-image-list').append('<li><a href="'+json['url']+'" title="'+json['url']+'" target="_blank">'+json['title']+'.'+format+'</a></li>');
								}
								else {
									//prevent caching
									$('#fnt-order-image-list').find('a[title="'+json['url']+'"]').attr('href', json['url']+'?t='+new Date().getTime());
								}
								
								$('#fpd-export-tools').removeClass('loading');

								}
							});

						}
						else { //dont save it on server

							var popup = window.open('','_blank');
							
								popup.document.title = element.title;


								if(format == 'svg') {
									source = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="'+stage.getWidth()+'" height="'+stage.getHeight()+'" xml:space="preserve">'+element.toSVG()+'</svg>';
									$(popup.document.body).append(source);
								}
								else {
									$(popup.document.body).append('<img src="'+source+'" title="Product" />');

								}

						}

						for(var i=0; i < objects.length; ++i) {

							var object = objects[i];
							if(object.viewIndex == currentViewIndex) {
								object.visible = true;
							}

						}

						element.set({scaleX: element.params.scale, scaleY: element.params.scale, padding: paddingTemp})
						.setClipTo(clipToTemp)
						.setCoords();

						stage.setBackgroundColor('transparent')
						.setDimensions({width: stageWidth, height: stageHeight})
						.renderAll();

					});

				}
				else {
					alert("<?php echo $text_error_selected;?>");
				}
			}

		});

		$('input[name="fpd_scale"]').keyup(function() {

			var scale = !isNaN(this.value) && this.value.length > 0 ? this.value : 1,
				mmInPx = 3.779528;

			$('#fpd-pdf-width').val(Math.round((stageWidth * scale) / mmInPx));
			$('#fpd-pdf-height').val(Math.round((stageHeight * scale) / mmInPx));

		}).keyup();

		function createImage() {

			var format = $('input[name="fpd_image_format"]:checked').val(),
				backgroundColor = format == 'jpeg' ? '#ffffff' : 'transparent',
				multiplier = $('input[name="fpd_scale"]').val().length == 0 ? 1 : Number($('input[name="fpd_scale"]').val()),
				dataURL;

			if($('[name="fpd_export_views"]:checked').val() == 'current') {
				dataURL = fancyProductDesigner.getViewDataURL(format, backgroundColor, multiplier);
			}
			else {
				dataURL = fancyProductDesigner.getProductDataURL(format, backgroundColor, multiplier);
			}

			var popup = window.open('','_blank');
			if (popup == null || typeof(popup)=='undefined') {
				alert("<?php echo $text_warning_popup_block;?>");
			}
			else {
				popup.document.title = $('[name="fpd_export_views"]:checked').val() == 'current' ? "<?php echo $text_current_view;?>" : "<?php echo $text_all_views;?>";
				$(popup.document.body).append('<img src="'+dataURL+'" title="<?php echo $text_title_image;?>" />');
			}


		};

		function createPdf() {

			if($('#fpd-pdf-width').val() == '') {
				alert("<?php echo $text_warning_set_width;?>");
				return false;
			}
			else if($('#fpd-pdf-height').val() == '') {
				alert("<?php echo $text_warning_set_width;?>");
				return false;
			}

			$('#fpd-export-tools').addClass('loading');

			var format = $('input[name="fpd_image_format"]:checked').val(),
				backgroundColor = format == 'jpeg' ? '#ffffff' : 'transparent',
				data;

			if(format == 'svg') {
				dataURLs = fancyProductDesigner.getViewsSVG();
			}
			else {
				var multiplier = $('input[name="fpd_scale"]').val().length == 0 ? 1 : Number($('input[name="fpd_scale"]').val());
				dataURLs = fancyProductDesigner.getViewsDataURL(format, backgroundColor, multiplier);
			}

			if($('[name="fpd_export_views"]:checked').val() == 'current') {
				var firstIndex = dataURLs[fancyProductDesigner.getViewIndex()];
				dataURLs = [];
				dataURLs.push(firstIndex);
			}
			var dataUrlsJson = dataURLs;
			$.ajax({
				url: "index.php?route=sale/fnt_order_product_design/createPdfFromDataUrl&token=<?php echo $token;?>",
				data: {
					order_id: <?php echo $order_id; ?>,
					item_id: <?php echo $order_product_id;?>,
					data_urls: dataUrlsJson,
					width: $('#fpd-pdf-width').val(),
					height: $('#fpd-pdf-height').val(),
					image_format: $('input[name="fpd_image_format"]:checked').val(),
					orientation: stageWidth > stageHeight ? 'L' : 'P'
				},
				type: 'post',
				dataType: 'json',
				success: function(json) {
					if(json == undefined) {
						alert('<?php echo $text_warning_message;?>');

					}
					else {
						window.open(json['url'], '_blank');
					}

					$('#fpd-export-tools').removeClass('loading');

				}
			});

		};

		function _checkAPI() {

			if(fancyProductDesigner.getStage().getObjects().length > 0 && isReady) {
				return true;
			}
			else {
				alert("<?php echo $text_error_create_fancy;?>");
				return false;
			}

		};


		// Convert dataURL to Blob object
		function _dataURLtoBlob(dataURL, imageFormat) {
		  var binary = atob(dataURL.split(',')[1]);
		  var array = [];
		  for(var i = 0; i < binary.length; i++) {
		      array.push(binary.charCodeAt(i));
		  }
		  // Return Blob object
		  return new Blob([new Uint8Array(array)], {type: 'image/'+imageFormat+''});
		}
	 });

</script>
</div>
</div>
    	</div>
		</div>
		</div>
	<?php echo $footer;?>	
	