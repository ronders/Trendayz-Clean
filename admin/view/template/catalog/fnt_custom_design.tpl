<?php echo $header;?>
<script type='text/javascript'>
/* <![CDATA[ */
var fpd_product_builder_opts = {"originX":"center","originY":"center","paddingControl":"7","defaultFont":"Arial","enterTitlePrompt":"Enter a title for the element","chooseElementImageTitle":"Choose an element image","set":"Set","enterYourText":"Enter your text.","removeElement":"Remove element?","notChanged":"You have not save your changes!"};
/* ]]> */
	$('#fpd-view-switcher').live('change', function (){
		var id = $(this).find('option:selected').parent().attr('id');
		<?php if(isset($product_ideas_id)){?>
			var url = 'index.php?route=catalog/fnt_custom_design&token=<?php echo $token;?>&product_ideas_element_id=' + this.value + '&product_ideas_id=' + id;
		<?php } else {?>
			var url = 'index.php?route=catalog/fnt_custom_design&token=<?php echo $token;?>&product_design_element_id=' + this.value + '&product_design_id=' + id;
		<?php }?>			
		window.location = url;
	});
	$('#save_elements').live('click', function(){
				
				<?php if(isset($product_ideas_id)){?>
					var url = 'index.php?route=catalog/fnt_custom_design/saveProductDesign&token=<?php echo $token; ?>&product_ideas_element_id=<?php echo $product_ideas_element_id; ?>&product_ideas_id=<?php echo $product_ideas_id;?>';
				<?php } elseif(isset($product_design_id)){?>
					var url = 'index.php?route=catalog/fnt_custom_design/saveProductDesign&token=<?php echo $token; ?>&product_design_element_id=<?php echo $product_design_element_id; ?>&product_design_id=<?php echo $product_design_id;?>';
				<?php }?>
				$.ajax({
					url: url,
					dataType: 'json',		
					type:'post',
					data: $('#fpd-submit').serialize(),
					success: function(json) {
						$('.alert').remove();
						if(json['success']){
							$('#fpd-product-builder').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i>' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						}
					}
				});
			
				return false;
			});
</script>
	<div id="content">
	 <ul class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
		<?php } ?>
	  </ul>
		<div class="container-fluid">
			<div id="success"></div>
		  <div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
			</div>
		<div class="panel-body">
		<div id="fpd-product-builder" class="wrap">
					<div>
					<p class="description"><strong><i><?php echo $text_select_view;?></i></strong></p>
					<?php if($products_design_element){?>
						<select id="fpd-view-switcher" style="display: none;">
							<?php foreach($products_design_element as $product_design_element){?>
								<?php if($product_design_element['children']){?>
									<optgroup id="<?php echo $product_design_element['id'];?>" label="<?php echo $product_design_element['name'];?>" style="padding-left:5px;">
										<?php foreach($product_design_element['children'] as $children){?>
											<?php if($product_design_element_id == $children['product_design_element_id']){?>
													<option selected="selected" value="<?php echo $children['product_design_element_id'];?>"><?php echo $children['name'];?></option>
												<?php } else {?>
													<option value="<?php echo $children['product_design_element_id'];?>"><?php echo $children['name'];?></option>
												<?php }?>
										<?php }?>
									</optgroup>
								<?php }?>	
							<?php }?>
						</select>
					<?php }?>	
					<?php if($products_ideas_element){?>
						<select id="fpd-view-switcher" style="display: none;">
							<?php foreach($products_ideas_element as $products_idea_element){?>
								<?php if($products_idea_element['children']){?>
									<optgroup id="<?php echo $products_idea_element['id'];?>" label="<?php echo $products_idea_element['name'];?>" style="padding-left:5px;">
										<?php foreach($products_idea_element['children'] as $children){?>
											<?php if($product_ideas_element_id == $children['product_ideas_element_id']){?>
													<option selected="selected" value="<?php echo $children['product_ideas_element_id'];?>"><?php echo $children['name'];?></option>
												<?php } else {?>
													<option value="<?php echo $children['product_ideas_element_id'];?>"><?php echo $children['name'];?></option>
												<?php }?>
										<?php }?>
									</optgroup>
								<?php }?>	
							<?php }?>
						</select>
					<?php }?>
					</div>
					<br />
					<!-- Manage elements -->
					<div id="fpd-manage-elements">

						<h3><?php echo $text_manage_elements;?></h3>
						<div id="fpd-add-element">
							<button id="fpd-add-image-element" class="btn btn-default"><?php echo $text_add_image;?></button>
							<button id="fpd-add-text-element" class="btn btn-default"><?php echo $text_add_text;?></button>
							<button class="btn btn-default" id="fpd-add-curved-text-element"><?php echo $text_add_curved_text;?></button>
							<button class="btn btn-default" id="fpd-add-upload-zone"><?php echo $text_add_upload_zone;?></button>
						</div>
						<form id="fpd-submit" method="post">

							<input type="hidden" name="view_id" value="1">
							<input type="hidden" name="fnt_image_upload" id="fnt_image_upload" value="">
							<input type="hidden" name="http_server" id="http_server" value="<?php echo $domain;?>">
							<ul id="fpd-elements-list" class="fpd-clearfix ui-sortable">
								<?php if($products_design){ $index = 0;?>
									<?php foreach($products_design as $product_design){?>
										<?php
										$change_image_icon = $product_design['type'] == 'image' ? '<span class="fa fa-refresh fpd-change-image" title="Change Image Source"></span>' : '';
										$element_identifier = $product_design['type'] == 'image' ? '<img src="'.$dir_image . $product_design['value'].'" />' : '<i class="fa fa-font"></i>';
										?>	
										<li id="<?php echo $index;?>">
											<input type="text" name="element_titles[]" value="<?php echo $product_design['type'] == 'image' ? $product_design['title'] : $product_design['value'];?>" />
											<?php echo $change_image_icon;?>
											<div class="fpd-element-identifier"><?php echo $element_identifier;?></div>
											<div class="fpd-clearfix">
												<span class="fa fa-unlock fpd-lock-element"></span>
												<span class="fa fa-times fpd-trash-element"></span>
											</div>
											<textarea name="element_sources[]"><?php echo $product_design['type'] == 'image' ? $dir_image . $product_design['value'] : $product_design['value'];?></textarea>
											<input type="hidden" name="element_types[]" value="<?php echo $product_design['type'];?>"/>
											<input type="hidden" name="element_parameters[]" value="<?php echo $product_design['parameters'];?>"/>
										</li>
										<?php $index++;?>
									<?php }?>
								<?php }?>	
							</ul>
							<p class="description"><?php echo $text_drag_list;?></p>
							<input type="button" class="btn btn-primary" name="save_elements" id="save_elements" value="Save Elements" />
						</form>

					</div>

					<!-- Edit Parameters -->
					<div id="fpd-edit-parameters">
						<h3><?php echo $text_edit_parameters;?> "<span id="fpd-edit-parameters-for"></span>"</h3>
						<form class="fpx-clearfix" id="fpd-elements-form" role="form">
							<!-- Hidden inputs for parameters set are set to true by default -->
								<input type="hidden" name="editable" value="0" />
								<input type="checkbox" name="locked" value="1" class="fpd-hidden" />
								<input type="checkbox" name="uploadZone" value="1" class="fpd-hidden" />

							<!-- Several inputs -->
							<div>
								<div>
									<h4><?php echo $text_position; ?></h4>
									<label><?php echo $text_x; ?>:<input type="text" name="x" size="3" placeholder="0" style="margin-right: 15px;" class="fpd-only-numbers"></label>
									<label><?php echo $text_y; ?>:<input type="text" name="y" size="3" placeholder="0" class="fpd-only-numbers"></label>
								</div>
								<div class="fpd-clearfix fpd-children-floated">
									<div>
										<label><h4><?php echo $text_scale; ?></h4>
										<input type="text" name="scale" size="3" placeholder="1" class="fpd-only-numbers fpd-allow-dots"></label>
									</div>
									<div>
										<label><h4><?php echo $text_angle; ?></h4>
										<input type="text" name="angle" size="3" placeholder="0" class="fpd-only-numbers"></label>
									</div>
									<div>
										<label><h4><?php echo $text_price; ?> <img class="help_tip" data-toggle="tooltip" title="<?php echo $text_use_always_a_dot; ?>" src="view/image/help.png" height="16" width="16" /></h4>
										<input type="text" name="price" size="3" placeholder="0" class="fpd-prevent-whitespace fpd-only-numbers fpd-allow-dots"></label>
									</div>
									<div>
										<label><h4><?php echo $text_opacity; ?> <img class="help_tip" data-toggle="tooltip" title="<?php echo $text_a_value_between; ?>" src="view/image/help.png" height="16" width="16" /></h4>
										<input type="text" name="opacity" size="3" placeholder="1" class="fpd-prevent-whitespace fpd-only-numbers fpd-allow-dots"></label>
									</div>
								</div>
								<div class="fpd-color-options">
									<label><h4><?php echo $text_colors; ?> <img class="help_tip" data-toggle="tooltip" title="<?php echo $text_one_color_value; ?>" src="view/image/help.png" height="16" width="16" /></h4>
									<input type="text" name="colors" class="tm-input" placeholder="<?php echo $text_e_g ; ?>" /></label>
								</div>
							</div>

							<!-- Checkers -->
							<div>
								<h4><?php echo $text_modifications; ?></h4>
								<label class="checkbox-inline"><input type="checkbox" name="removable" value="1"> <?php echo $text_removable; ?></label>
								<label class="checkbox-inline"><input type="checkbox" name="draggable" value="1"> <?php echo $text_draggable; ?></label>
								<label class="checkbox-inline"><input type="checkbox" name="rotatable" value="1"> <?php echo $text_rotatable; ?></label>
								<label class="checkbox-inline"><input type="checkbox" name="resizable" value="1"> <?php echo $text_resizable; ?></label>
								<label class="checkbox-inline"><input type="checkbox" name="zChangeable" value="1"> <?php echo $text_z_position; ?></label>
								<label class="checkbox-inline"><input type="checkbox" name="topped" value="1"> <?php echo $text_stay_on_top; ?></label>
								<label class="checkbox-inline"><input type="checkbox" name="autoSelect" value="1"> <?php echo $text_auto_select; ?></label>
								<div class="fpd-color-options">
									<label><?php echo $text_current_color;?> <img class="help_tip" data-toggle="tooltip" title="Enter one hexadecimal color to change the initial color of this element." src="view/image/help.png" height="16" width="16" /><input type="text" name="currentColor" placeholder="e.g. #000000" size="9" /></label>
									
								</div>
							</div>

							<!-- Bounding Box -->
							<div>
								<div>
									<h4><?php echo $text_bounding_box; ?></h4>
									<label class="checkbox-inline"><input type="checkbox" name="bounding_box_control" value="1"> <?php echo $text_use_another_element; ?></label>
									<label class="checkbox-inline"><input type="checkbox" name="boundingBoxClipping" value="1"> <?php echo $text_clip_element_into_bounding_box; ?></label>
									<br />
									<div id="boundig-box-params">
										<label><?php echo $text_x; ?>:<input type="text" name="bounding_box_x" size="3" placeholder="0" style="margin-right: 15px;"></label>
										<label><?php echo $text_y; ?>:<input type="text" name="bounding_box_y" size="3" placeholder="0"></label>
										<br />
										<label><?php echo $text_width; ?>:<input type="text" name="bounding_box_width" size="3" placeholder="0" style="margin-right: 15px;"></label>
										<label><?php echo $text_height; ?>:<input type="text" name="bounding_box_height" size="3" placeholder="0"></label>
									</div>
									<label><input type="text" name="bounding_box_by_other" class="widefat input-sm" placeholder="<?php echo $text_title_of_an_image_element; ?>" style="display: none;" /></label>
								</div>
								<div>
								<label><h4><?php echo $text_replace; ?><img class="help_tip" data-toggle="tooltip" title="<?php echo $text_elements_with; ?>" src="view/image/help.png" height="16" width="16" /></h4>
								<input type="text" name="replace" value="" class="widefat input-sm"></label>
								</div>
							</div>

							<!-- Parameters only for text elements -->
							<div class="only-for-text-elements">
								<div>
									<h4><?php echo $text_font; ?></h4>
									<select name="font" data-placeholder="<?php echo $text_select_a_font; ?>" class="fpd-font-changer">
										<?php foreach($fonts as $font) {?>
											<option value='<?php echo $font;?>' style='font-family: <?php echo $font;?>'><?php echo $font;?></option>
										<?php }?>
									</select>
								</div>
								<div class="fpd-clearfix fpd-children-floated">
									<div class="fpd-text-styling">
										<h4><?php echo $text_styling; ?></h4>
										<button class="fpd-bold button"><i class="fa fa-bold"></i></button>
										<button class="fpd-italic button"><i class="fa fa-italic"></i></button>
										<input type="checkbox" name="fontWeight" value="bold" class="fpd-hidden" />
										<input type="checkbox" name="fontStyle" value="italic" class="fpd-hidden" />
									</div>
									<div class="fpd-text-align">
										<h4><?php echo $text_alignment; ?> <i class="fpd-help fa fa-question-circle" data-toggle="tooltip" title="<?php echo $text_text_alignment; ?>"></i></h4>
										<button class="fpd-align-left button" data-value="left"><i class="fa fa-align-left"></i></button>
										<button class="fpd-align-center button" data-value="center"><i class="fa fa-align-center"></i></button>
										<button class="fpd-align-right button" data-value="right"><i class="fa fa-align-right"></i></button>
										<input type="hidden" name="textAlign" value="left" />
									</div>
									<div>
										<label class="checkbox-inline"><?php echo $text_maximum_characters; ?>
										<input type="text" name="maxLength" size="3" placeholder="0" class="fpd-only-numbers"></label>
									</div>
								</div>
								<div class="fpd-clearfix fpd-children-floated fpd-two-column">
									<div>
										<h4><?php echo $text_modifications; ?></h4>
										<label class="checkbox-inline"><input type="checkbox" name="editable" value="1"> <?php echo $text_editable; ?></label>
										<label class="checkbox-inline"><input type="checkbox" name="patternable" value="1"> <?php echo $text_patternable; ?></label>
										<label class="checkbox-inline"><input type="checkbox" name="curvable" value="1"> <?php echo $text_curvable; ?></label>
									</div>
								</div>
								<div id="fpd-curved-text-opts">
									<h4><?php echo $text_curved;?></h4>
										<input type="checkbox" name="curved" value="1" class="fpd-hidden">
										<label style="width: 60px;"><?php echo $text_spacing;?></label><input type="text" name="curveSpacing" size="3" placeholder="10" class="fpd-only-numbers">
										<label style="width: 60px;"><?php echo $text_radius;?></label><input type="text" name="curveRadius" size="3" placeholder="80" class="fpd-only-numbers">
										<label class="checkbox-inline"><input type="checkbox" name="curveReverse" value="1"><?php echo $text_reverse;?></label>
								</div>
							</div>

		</div>
	</form></div>

					<!-- Product Stage -->
					<div id="fpd-product-stage">
						<h3 class="fpd-clearfix"><?php echo $text_product_stage;?><span class="description"><?php echo $config_stage_width;?>px * <?php echo $config_stage_height;?>px</span>
							<a style="float: right;" data-toggle="tooltip" title="<?php echo $text_help_text_problems;?>" class="fpd-help"><?php echo $text_problems;?></a>
						</h3>
						<div id="fpd-element-toolbar">
							<button title="Center Element Horizontal" class="button button-secondary fpd-center-horizontal"><i class="fa fa-arrows-h"></i></button>
							<button title="Center Element Vertical" class="button button-secondary fpd-center-vertical"><i class="fa fa-arrows-v"></i></button>
						</div>
						<div id="fpd-fabric-stage-wrapper">
						<canvas id="fpd-fabric-stage" width="<?php echo $config_stage_width;?>" height="<?php echo $config_stage_height;?>"></canvas>
					</div>
					</div>
				</div>
	</div>	
	</div>	
	</div>	
	</div>
<?php echo $footer;?>