<?php echo $header; ?>
<div id="content">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
    <div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
			<a onclick="saveProductAndDesign();" data-toggle="tooltip" title="<?php echo $button_save_design; ?>" class="btn btn-primary"><?php echo $button_save_design; ?></a>
			<button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
			<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
			<h1 class="panel-title"><i class="fa fa-pencil-square fa-lg"></i> <?php echo $heading_title; ?></h1>
		</div>
      
    </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
    </div>
    <div class="panel-body">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
		<ul style="margin-bottom:10px" class="nav nav-tabs">
          <li class="active"><a style="text-decoration:none" href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
          <li><a style="text-decoration:none" href="#tab-images" data-toggle="tab"><?php echo $tab_view; ?></a></li>
          <li><a style="text-decoration:none" href="#tab-setting" data-toggle="tab"><?php echo $tab_setting; ?></a></li>
        </ul>
      <div class="tab-content">
          <div class="tab-pane active" id="tab-data">
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
              <div class="col-sm-10">
                <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
                <?php if ($error_name) { ?>
                <div class="text-danger"><?php echo $error_name; ?></div>
                <?php } ?>
              </div>
            </div>
			 <div class="form-group">
              <label class="col-sm-2 control-label" for="input-product"><?php echo $entry_product; ?></label>
              <div class="col-sm-10">
                <input type="text" name="product" value="<?php echo $product ?>" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                <span class="help-block"><?php echo $help_product; ?></span></div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-category"><?php echo $entry_category; ?></label>
              <div class="col-sm-10">
                <input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
                <span class="help-block"><?php echo $help_category; ?></span>
                <div id="clipart-category" class="well well-sm" style="height: 150px; overflow: auto;">
                  <?php foreach ($clipart_categories as $clipart_category) { ?>
                  <div id="clipart-category<?php echo $clipart_category['category_clipart_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $clipart_category['name']; ?>
                    <input type="hidden" name="clipart_category[]" value="<?php echo $clipart_category['category_clipart_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
			<div class="form-group">
              <label class="col-sm-2 control-label" for="input-category-design"><?php echo $entry_category_design; ?></label>
              <div class="col-sm-10">
                <input type="text" name="category-design" value="" placeholder="<?php echo $entry_category_design; ?>" id="input-category-design" class="form-control" />
                <span class="help-block"><?php echo $help_category; ?></span>
                <div id="category-design" class="well well-sm" style="height: 150px; overflow: auto;">
                  <?php foreach ($categories_design as $category) { ?>
                  <div id="category-design<?php echo $category['category_design_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $category['name']; ?>
                    <input type="hidden" name="category_design[]" value="<?php echo $category['category_design_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
			 <div class="form-group">
              <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
              <div class="col-sm-10">
                <select name="status" id="input-status" class="form-control">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tab-images">
            <div class="table-responsive">
			<p class="toolbar text-right">
			<input type="file" value="Upload" class="fpd-hidden" id="fpd-file-import" />
			<?php if($product_design_id != 0){?>
				<a class="btn btn-primary" id="fpd-import"><?php echo $text_import;?></a>
			<?php } else {?>
				<a class="btn btn-primary" onClick='alert("Warning: You can not import data when create product!")'><?php echo $text_import;?></a>
			<?php }?>
			<a class="btn btn-primary" id="fpd-export"><?php echo $text_export;?></a>
		</p>
              <table id="images" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <td class="text-left"><?php echo $entry_image; ?></td>
                    <td class="text-left"><?php echo $entry_view_name; ?></td>
                    <td class="text-left"><?php echo $entry_sort_order; ?></td>
                    <td></td>
                  </tr>
                </thead>
                <tbody id="tab-design-views">
                  <?php $image_row = 0; ?>
                  <?php foreach ($product_images as $product_image) { ?>
                  <tr id="image-row<?php echo $image_row; ?>">
                    <td class="text-left">
                     <img class="img-thumbnail img-edit" src="<?php echo $product_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                    <input type="hidden" name="product_image[<?php echo $image_row; ?>][image]" value="<?php echo $product_image['image']; ?>" id="image<?php echo $image_row; ?>" />
                    <br />
                    <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a>
                      <input type="hidden" name="product_image[<?php echo $image_row; ?>][product_design_element_id]" value="<?php echo $product_image['product_design_element_id']; ?>" /></td>
                    <td class="text-right"><input type="text" name="product_image[<?php echo $image_row; ?>][name]" value="<?php echo $product_image['name']; ?>" placeholder="<?php echo $entry_view_name; ?>" class="form-control" /></td>
                    <td class="text-left"><input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
                    <td class="text-left">
						<a href="<?php echo $product_image['edit']; ?>" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $text_edit;?>"><i class="fa fa-edit"></i> <?php echo $button_edit; ?></a>
						<button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="btn btn-danger" data-toggle="tooltip" title="<?php echo $button_remove;?>"><i class="fa fa-minus-circle"></i> <?php echo $button_remove; ?></button>
					</td>
                  </tr>
                  <?php $image_row++; ?>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3"></td>
                    <td class="text-left"><a onclick="addImage();" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_image_add; ?>"><i class="fa fa-plus-circle"></i> <?php echo $button_image_add; ?></a></td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

		  <div class="tab-pane" id="tab-setting">
			<div class="fpd-modal-wrapper" id="fpd-modal-settings">
				<h3><?php echo $text_individual_setting; ?></h3>
				<p class="description"><?php echo $text_des_individual_setting; ?></p>
				<br />
				<ul class="nav nav-tabs" style="margin-bottom:10px">
					<li class="active"><a style="text-decoration:none" href="#tab1" data-toggle="tab"><?php echo $tab_general; ?></a></li>
					<li><a style="text-decoration:none" href="#tab2" data-toggle="tab"><?php echo $tab_image_parameter; ?></a></li>
					<li><a style="text-decoration:none" href="#tab3" data-toggle="tab"><?php echo $tab_custom_text_parameter; ?></a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_theme; ?></label>
							<div class="col-sm-3">
								<select name="parameters[layout]" class="form-control">
									<?php foreach($themes as $value){?>
										<?php if($value['value'] == $parameters['layout']){?>
											<option selected="selected" value="<?php echo $value['value'];?>"><?php echo $value['title'];?></option>
										<?php } else { ?>
											<option value="<?php echo $value['value'];?>"><?php echo $value['title'];?></option>
										<?php }?>	
									<?php }?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_view_selection_floated; ?></label>
							<div class="col-sm-3">
								<?php if(isset($parameters['view_selection_floated']) && $parameters['view_selection_floated']){?>
									<input type="checkbox" name="parameters[view_selection_floated]" checked="checked" />
								<?php } else {?>
									<input type="checkbox" name="parameters[view_selection_floated]" />
								<?php }?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_stage_width; ?></label>
							<div class="col-sm-3">
								<input type="text" name="parameters[stage_width]" value="<?php echo (isset($parameters['stage_width']) && $parameters['stage_width']) ? $parameters['stage_width'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_stage_height; ?></label>
							<div class="col-sm-3">
								<input type="text" name="parameters[stage_height]" value="<?php echo (isset($parameters['stage_height']) && $parameters['stage_height']) ? $parameters['stage_height'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_background_type; ?></label>
							<div class="col-sm-3 ">
								<?php if(isset($parameters['background_type']) && $parameters['background_type'] == 'image'){?>
									<input type="radio" name="parameters[background_type]" value="image" checked="checked" /> <?php echo $text_background_type_image; ?>
									<input type="radio" name="parameters[background_type]" value="color" /> <?php echo $text_background_type_color; ?>
									<input type="radio" name="parameters[background_type]" value="none" /> <?php echo $text_background_type_none; ?>
								<?php } elseif(isset($parameters['background_type']) && $parameters['background_type'] == 'color') { ?>
									<input type="radio" name="parameters[background_type]" value="image" /> <?php echo $text_background_type_image; ?>
									<input type="radio" name="parameters[background_type]" value="color" checked="checked" /> <?php echo $text_background_type_color; ?>
									<input type="radio" name="parameters[background_type]" value="none" /> <?php echo $text_background_type_none; ?>
								<?php } else { ?>
									<input type="radio" name="parameters[background_type]" value="image" /> <?php echo $text_background_type_image; ?>
									<input type="radio" name="parameters[background_type]" value="color" /> <?php echo $text_background_type_color; ?>
									<input type="radio" name="parameters[background_type]"  checked="checked" value="none" /> <?php echo $text_background_type_none; ?>
								<?php }?>
							</div>
						</div>
						<div class="form-group" style="display:none">
							<label class="col-sm-2 control-label"><?php echo $entry_background_image; ?></label>
							<div class="col-sm-3">
								<div class="image"><img src="<?php echo $thumb_background; ?>" alt="" id="background_thumb" /><br />
									<input type="hidden" name="parameters[image]" value="<?php echo (isset($parameters['image']) && $parameters['image']) ? $parameters['image'] : '';?>" id="background_image" />
										<a onclick="image_upload('background_image', 'background_thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#background_thumb').attr('src', '<?php echo $no_image; ?>'); $('#background_image').attr('value', '');"><?php echo $text_clear; ?></a>
								</div>
							</div>
						</div>
						<div class="form-group" style="display:none">
							<label class="col-sm-2 control-label"><?php echo $entry_background_color; ?></label>
							<div class="col-sm-3">
								<input type="text" name="parameters[background_color]" value="<?php echo (isset($parameters['background_color']) && $parameters['background_color']) ? $parameters['background_color'] : '#FFFFFF';?>" class="form-control color {hash:true}" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_hide_designs_tab; ?></label>
							<div class="col-sm-3">
								<input type="checkbox" name="parameters[hide_designs_tab]" <?php echo (isset($parameters['hide_designs_tab']) && $parameters['hide_designs_tab']) ? 'checked="checked"' : '';?>/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_hide_facebook_tab; ?></label>
							<div class="col-sm-3">
								<input type="checkbox" name="parameters[hide_facebook_tab]" <?php echo (isset($parameters['hide_facebook_tab']) && $parameters['hide_facebook_tab']) ? 'checked="checked"' : '';?> />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_hide_instagram_tab; ?></label>
							<div class="col-sm-3">
								<input type="checkbox" name="parameters[hide_instagram_tab]" <?php echo (isset($parameters['hide_instagram_tab']) && $parameters['hide_instagram_tab']) ? 'checked="checked"' : '';?> />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_hide_custom_image_upload; ?></label>
							<div class="col-sm-3">
								<input type="checkbox" name="parameters[hide_custom_image_upload]" <?php echo (isset($parameters['hide_custom_image_upload']) && $parameters['hide_custom_image_upload']) ? 'checked="checked"' : '';?> />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_hide_custom_text; ?></label>
							<div class="col-sm-3">
								<input type="checkbox" name="parameters[hide_custom_text]" <?php echo (isset($parameters['hide_custom_text']) && $parameters['hide_custom_text']) ? 'checked="checked"' : '';?> />
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab2">
						<h3><?php echo $text_custom_control; ?></h3>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_designs_parameter_price; ?></label>
							<div class="col-sm-3">
								<input type="number" min="0" step="0.01" name="parameters[designs_parameter_price]" value="<?php echo (isset($parameters['designs_parameter_price']) && $parameters['designs_parameter_price']) ? $parameters['designs_parameter_price'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_designs_parameter_replace; ?></label>
							<div class="col-sm-3">
								<input type="text" name="parameters[designs_parameter_replace]" value="<?php echo (isset($parameters['designs_parameter_replace']) && $parameters['designs_parameter_replace']) ? $parameters['designs_parameter_replace'] : '';?>" placeholder="" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_designs_parameter_bounding_box_control; ?></label>
							<div class="col-sm-3">
								<select name="parameters[designs_parameter_bounding_box_control]" class="form-control">
									<?php if(isset($parameters['designs_parameter_bounding_box_control']) && $parameters['designs_parameter_bounding_box_control'] == 1){?>
										<option value="0"><?php echo $text_use_option_main_setting; ?></option>
										<option value="1" data-class="custom-bb" selected="selected"><?php echo $text_custom_bounding_box; ?></option>
										<option value="2" data-class="target-bb"><?php echo $text_use_another_element_as_bounding_box; ?></option>
									<?php } elseif(isset($parameters['designs_parameter_bounding_box_control']) && $parameters['designs_parameter_bounding_box_control'] == 2){?>	
										<option value="0"><?php echo $text_use_option_main_setting; ?></option>
										<option value="1" data-class="custom-bb"><?php echo $text_custom_bounding_box; ?></option>
										<option value="2" data-class="target-bb" selected="selected"><?php echo $text_use_another_element_as_bounding_box; ?></option>
									<?php }else{?>
										<option value="0"><?php echo $text_use_option_main_setting; ?></option>
										<option value="1" data-class="custom-bb"><?php echo $text_custom_bounding_box; ?></option>
										<option value="2" data-class="target-bb"><?php echo $text_use_another_element_as_bounding_box; ?></option>
									<?php }?>	
								</select>
							</div>
						</div>
						
						<div class="form-group custom-bb"">
							<label class="col-sm-2 control-label"><?php echo $entry_designs_parameter_bounding_box_x; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[designs_parameter_bounding_box_x]" min="0" step="1" value="<?php echo (isset($parameters['designs_parameter_bounding_box_x']) && $parameters['designs_parameter_bounding_box_x']) ? $parameters['designs_parameter_bounding_box_x'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group custom-bb">
							<label class="col-sm-2 control-label"><?php echo $entry_designs_parameter_bounding_box_y; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[designs_parameter_bounding_box_y]" min="0" step="1" value="<?php echo (isset($parameters['designs_parameter_bounding_box_y']) && $parameters['designs_parameter_bounding_box_y']) ? $parameters['designs_parameter_bounding_box_y'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						
						<div class="form-group custom-bb">
							<label class="col-sm-2 control-label"><?php echo $entry_designs_parameter_bounding_box_width; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[designs_parameter_bounding_box_width]" min="0" step="1" value="<?php echo (isset($parameters['designs_parameter_bounding_box_width']) && $parameters['designs_parameter_bounding_box_width']) ? $parameters['designs_parameter_bounding_box_width'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						
						<div class="form-group custom-bb">
							<label class="col-sm-2 control-label"><?php echo $entry_designs_parameter_bounding_box_height; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[designs_parameter_bounding_box_height]" min="0" step="1" value="<?php echo (isset($parameters['designs_parameter_bounding_box_height']) && $parameters['designs_parameter_bounding_box_height']) ? $parameters['designs_parameter_bounding_box_height'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						
						<div class="form-group target-bb">
							<label class="col-sm-2 control-label"><?php echo $entry_designs_parameter_bounding_box_by_other; ?></label>
							<div class="col-sm-3">
								<input type="text" name="parameters[designs_parameter_bounding_box_by_other]" value="<?php echo (isset($parameters['designs_parameter_bounding_box_by_other']) && $parameters['designs_parameter_bounding_box_by_other']) ? $parameters['designs_parameter_bounding_box_by_other'] : '';?>" placeholder="" class="form-control" />
							</div>
						</div>
						<h3><?php echo $text_custom_image; ?></h3>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_uploaded_designs_parameter_minW; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[uploaded_designs_parameter_minW]" min="1" step="1" value="<?php echo (isset($parameters['uploaded_designs_parameter_minW']) && $parameters['uploaded_designs_parameter_minW']) ? $parameters['uploaded_designs_parameter_minW'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_uploaded_designs_parameter_minH; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[uploaded_designs_parameter_minH]" min="1" step="1" value="<?php echo (isset($parameters['uploaded_designs_parameter_minH']) && $parameters['uploaded_designs_parameter_minH']) ? $parameters['uploaded_designs_parameter_minH'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_uploaded_designs_parameter_maxW; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[uploaded_designs_parameter_maxW]" min="1" step="1" value="<?php echo (isset($parameters['uploaded_designs_parameter_maxW']) && $parameters['uploaded_designs_parameter_maxW']) ? $parameters['uploaded_designs_parameter_maxW'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_uploaded_designs_parameter_maxH; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[uploaded_designs_parameter_maxH]" min="1" step="1" value="<?php echo (isset($parameters['uploaded_designs_parameter_maxH']) && $parameters['uploaded_designs_parameter_maxH']) ? $parameters['uploaded_designs_parameter_maxH'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_uploaded_designs_parameter_resizeToW; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[uploaded_designs_parameter_resizeToW]" min="1" step="1" value="<?php echo (isset($parameters['uploaded_designs_parameter_resizeToW']) && $parameters['uploaded_designs_parameter_resizeToW']) ? $parameters['uploaded_designs_parameter_resizeToW'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_uploaded_designs_parameter_resizeToH; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[uploaded_designs_parameter_resizeToH]" min="1" step="1" value="<?php echo (isset($parameters['uploaded_designs_parameter_resizeToH']) && $parameters['uploaded_designs_parameter_resizeToH']) ? $parameters['uploaded_designs_parameter_resizeToH'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab3">
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_custom_texts_parameter_bounding_box_control; ?></label>
							<div class="col-sm-3">
								<select name="parameters[custom_texts_parameter_bounding_box_control]" class="form-control">
									<?php if(isset($parameters['custom_texts_parameter_bounding_box_control']) && $parameters['custom_texts_parameter_bounding_box_control'] == 1){?>
										<option value="0"><?php echo $text_use_option_main_setting; ?></option>
										<option value="1" data-class="custom-bb" selected="selected"><?php echo $text_custom_bounding_box; ?></option>
										<option value="2" data-class="target-bb"><?php echo $text_use_another_element_as_bounding_box; ?></option>
									<?php } elseif(isset($parameters['custom_texts_parameter_bounding_box_control']) && $parameters['custom_texts_parameter_bounding_box_control'] == 2){?>	
										<option value="0"><?php echo $text_use_option_main_setting; ?></option>
										<option value="1" data-class="custom-bb"><?php echo $text_custom_bounding_box; ?></option>
										<option value="2" data-class="target-bb" selected="selected"><?php echo $text_use_another_element_as_bounding_box; ?></option>
									<?php }else{?>
										<option value="0"><?php echo $text_use_option_main_setting; ?></option>
										<option value="1" data-class="custom-bb"><?php echo $text_custom_bounding_box; ?></option>
										<option value="2" data-class="target-bb"><?php echo $text_use_another_element_as_bounding_box; ?></option>
									<?php }?>	
								</select>
							</div>
						</div>
						<div class="form-group custom-bb">
							<label class="col-sm-2 control-label"><?php echo $entry_custom_texts_parameter_bounding_box_x; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[custom_texts_parameter_bounding_box_x]" min="0" step="1" value="<?php echo (isset($parameters['custom_texts_parameter_bounding_box_x']) && $parameters['custom_texts_parameter_bounding_box_x']) ? $parameters['custom_texts_parameter_bounding_box_x'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group custom-bb">
							<label class="col-sm-2 control-label"><?php echo $entry_custom_texts_parameter_bounding_box_y; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[custom_texts_parameter_bounding_box_y]" min="0" step="1" value="<?php echo (isset($parameters['custom_texts_parameter_bounding_box_y']) && $parameters['custom_texts_parameter_bounding_box_y']) ? $parameters['custom_texts_parameter_bounding_box_y'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group custom-bb">
							<label class="col-sm-2 control-label"><?php echo $entry_custom_texts_parameter_bounding_box_width; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[custom_texts_parameter_bounding_box_width]" min="0" step="1" value="<?php echo (isset($parameters['custom_texts_parameter_bounding_box_width']) && $parameters['custom_texts_parameter_bounding_box_width']) ? $parameters['custom_texts_parameter_bounding_box_width'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group custom-bb">
							<label class="col-sm-2 control-label"><?php echo $entry_custom_texts_parameter_bounding_box_height; ?></label>
							<div class="col-sm-3">
								<input type="number" name="parameters[custom_texts_parameter_bounding_box_height]" min="0" step="1" value="<?php echo (isset($parameters['custom_texts_parameter_bounding_box_height']) && $parameters['custom_texts_parameter_bounding_box_height']) ? $parameters['custom_texts_parameter_bounding_box_height'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group target-bb">
							<label class="col-sm-2 control-label"><?php echo $entry_custom_texts_parameter_bounding_box_by_other; ?></label>
							<div class="col-sm-3">
								<input type="text" name="parameters[custom_texts_parameter_bounding_box_by_other]" value="<?php echo (isset($parameters['custom_texts_parameter_bounding_box_by_other']) && $parameters['custom_texts_parameter_bounding_box_by_other']) ? $parameters['custom_texts_parameter_bounding_box_by_other'] : '';?>" placeholder="" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_default_text; ?></label>
							<div class="col-sm-3">
								<input type="text" name="parameters[default_text]" value="<?php echo (isset($parameters['default_text']) && $parameters['default_text']) ? $parameters['default_text'] : '';?>" placeholder="" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_custom_texts_parameter_price; ?></label>
							<div class="col-sm-3">
								<input type="number" min="0" step="0.01" name="parameters[custom_texts_parameter_price]" value="<?php echo (isset($parameters['custom_texts_parameter_price']) && $parameters['custom_texts_parameter_price']) ? $parameters['custom_texts_parameter_price'] : '';?>" placeholder="0" class="form-control" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_custom_texts_parameter_colors; ?></label>
							<div class="col-sm-3">
								<input type="text" name="parameters[custom_texts_parameter_colors]" value="<?php echo (isset($parameters['custom_texts_parameter_colors']) && $parameters['custom_texts_parameter_colors']) ? $parameters['custom_texts_parameter_colors'] : '';?>" placeholder="0" class="form-control color {hash:true}" />
							</div>
						</div>
					</div>
				</div>
            </div>
          </div>
        </div>
      </form>
    </div>  
   </div>
 </div>
</div>
<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request)+'&type=fnt_design',
			dataType: 'json',			
			success: function(json) {
				json.unshift({
					'product_id': '',
					'name': '<?php echo $text_none; ?>'
				});
				
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'product\']').val(item['label']);
		$('input[name=\'product_id\']').val(item['value']);
	}	
});

// Category
$('input[name=\'category\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/fnt_category_clipart/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_clipart_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category\']').val('');
		
		$('#clipart-category' + item['value']).remove();
		
		$('#clipart-category').append('<div id="clipart-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="clipart_category[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#clipart-category').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

// Category Design
$('input[name=\'category-design\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/fnt_category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['category_design_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'category-design\']').val('');
		
		$('#fnt_category-design' + item['value']).remove();
		
		$('#category-design').append('<div id="category-design' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="category_design[]" value="' + item['value'] + '" /></div>');	
	}
});

$('#category-design').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

//--></script> 

<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {	
	html  = '<tr id="image-row' + image_row + '">';
	html += '  <td class="text-left"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a><input type="hidden" name="product_image[' +image_row+'][product_design_element_id]" value="" /></td>';
	html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][name]" value="" placeholder="<?php echo $entry_view_name; ?>" class="form-control" /></td>';
	html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';
	html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" class="btn btn-danger"><i class="fa fa-minus-circle"></i> <?php echo $button_remove; ?></button></td>';
	html += '</tr>';	
	$('#images tbody').append(html);	
	image_row++;
}
function saveProductAndDesign() {
	var action = $('#form-product').attr('action') + '&design=1'
	$('#form-product').attr('action',action);
	$('#form-product').submit();
}
//--></script>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
 
<script type="text/javascript">
		$viewsList = $('#tab-design-views'),
		$modalWrapper = $('#fpd-modal-settings');
		//export product
		$('#fpd-export').click(function(evt) {
			if($viewsList.children('tr').length == 0) {

				alert("Nothing to export. You have not created views for this product. Please create one or more views!");
				return;
			}

			var urlAjaxExport = 'index.php?route=catalog/fnt_product_design/export&token=<?php echo $token; ?>&product_design_id=<?php echo $product_design_id;?>';
			location.href = urlAjaxExport;

			evt.preventDefault();

		});
		//import product
		$('#fpd-import').click(function(evt) {
			$('#fpd-file-import').click();
			evt.preventDefault();

		});

		$('#fpd-file-import').change(function(evt) {

			if(window.FileReader) {

				var reader = new FileReader();
				reader.readAsText(evt.target.files[0]);
				reader.onload = function (evt) {

					var file = evt.target.result,
						json;

					try {
					  json = JSON.parse(file);
					} catch (exception) {
					  json = null;
					}

					if(json == null) {
						alert('Sorry, but the selected file is not a valid JSON object. Are you sure you have selected the correct file to import?');
					}
					else {
						_importViews(json);
					}

				};
			}

			$('#fpd-file-import').val('');
		});
		function _importViews(views) {

			var keys = Object.keys(views),
				viewCount = 0;

			function _importView(view) {
				$.ajax({
					url: 'index.php?route=catalog/fnt_product_design/import&token=<?php echo $token; ?>&product_design_id=<?php echo $product_design_id;?>',
					data: {
						elements: view.elements,
						thumbnail: view.thumbnail,
						title: view.title,
						thumbnail_name: view.thumbnail_name ? view.thumbnail_name : view.title,
						product_design_id: <?php echo $product_design_id;?>
					},
					type: 'post',
					dataType: 'json',
					success: function(data) {

						viewCount++;

						if(data == 0) {
							alert('Could not create view. Please try again!');
							
						}
						else {
							$viewsList.append(data['success']);
							image_row++;
						}

						if(viewCount < keys.length) {
							_importView(views[keys[viewCount]]);
						}
						else {
							
						}

					}
				});

			}

			if(!keys.length == 0) {
			
				_importView(views[keys[0]]);
			}

		};

		function _serializeObject(fields) {
		    var o = {};
		    var a = fields.serializeArray();
		    $.each(a, function() {
		        if (o[this.name] !== undefined) {
		            if (!o[this.name].push) {
		                o[this.name] = [o[this.name]];
		            }
					if(this.value) {
						o[this.name].push(this.value || '');
					}

		        } else {
		        	if(this.value) {
			        	o[this.name] = this.value || '';
		        	}
		        }
		    });
		    return o;
		};

		function _serializedStringToObject(string) {

			var splitParams = string.split("&");

			//convert parameter string into object
			var object = {};
			for(var i=0; i < splitParams.length; ++i) {
				var splitIndex = splitParams[i].indexOf("=");
				object[splitParams[i].substr(0, splitIndex)] = splitParams[i].substr(splitIndex+1).replace(/\_/g, ' ');
			}
			return object;
		};
		$(document).ready(function() {
			$modalWrapper.find('[name="parameters[background_type]"]:checked').change();
			$modalWrapper.find('select').trigger('change');
		});
		//background type switcher
		$modalWrapper.find('[name="parameters[background_type]"]').change(function() {

			if(this.value == 'image') {
				$modalWrapper.find('#background_thumb').parents('.form-group').show();
				$modalWrapper.find('[name="parameters[background_color]"]').parents('.form-group').hide();
			}
			else if(this.value == 'color') {
				$modalWrapper.find('[name="parameters[background_color]"]').parents('.form-group').show();
				$modalWrapper.find('#background_thumb').parents('.form-group').hide();
			} else if(this.value == 'none') {
				$modalWrapper.find('#background_thumb').parents('.form-group').hide();
				$modalWrapper.find('[name="parameters[background_color]"]').parents('.form-group').hide();
			}
		});
		//bounding box switcher
		$('[name="parameters[designs_parameter_bounding_box_control]"], [name="parameters[custom_texts_parameter_bounding_box_control]"]').change(function() {
			var $this = $(this),
			$tbody = $this.parents('.tab-pane:first');
			$tbody.find('.custom-bb, .target-bb').hide().addClass('no-serialization');
			if(this.value != '') {
				$tbody.find('.'+$this.find(":selected").data('class')).show().removeClass('no-serialization');
			}
		});
</script>
<?php echo $footer; ?>