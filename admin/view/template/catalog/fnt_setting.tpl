<?php echo $header; ?>
<script type="text/javascript" src="view/javascript/jquery/jscolor/jscolor.js"></script>
<div id="content">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
    
    <div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<!--<button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button> -->
				<button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $text_save_edit; ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $text_save_edit;?></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
			<h1 class="panel-title"><i class="fa fa-puzzle-piece fa-lg"></i> <?php echo $heading_title; ?></h1>
		</div>
    </div>
    <div class="container-fluid">
		<?php if ($error_warning) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
		<?php if ($success) { ?>
		<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		<?php } ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
		</div>
		<div class="panel-body">		
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-featured" class="form-horizontal">
		<div class="tab-content">
	  	<ul class="nav nav-tabs">
		<li class="active" ><a href="#general" data-toggle="tab"><?php echo $text_general;?></a></li>
		<li><a href="#design" data-toggle="tab"><?php echo $text_design_image;?></a></li>
		<li><a href="#custom" data-toggle="tab"><?php echo $text_custom;?></a></li>
		</ul> 
		<div id="general" class="tab-pane active">
		<h4><?php echo $text_title_general;?></h4>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_theme; ?>:</label>
			<div class="col-sm-2">
				<select class="form-control" name="config_theme">
					<?php foreach($themes as $value){?>
						<?php if($value['value'] == $config_theme){?>
							<option selected="selected" value="<?php echo $value['value'];?>"><?php echo $value['title'];?></option>
						<?php } else { ?>
							<option value="<?php echo $value['value'];?>"><?php echo $value['title'];?></option>
						<?php }?>	
					<?php }?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_sidebar_content_width; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_sidebar_content_width;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-2">
				<input type="text" name="config_sidebar_content_width" value="<?php echo $config_sidebar_content_width; ?>" placeholder="<?php echo $entry_sidebar_content_width; ?>" class="form-control" />
			</div>
		</div>
		
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_stage_width; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_stage_width;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-2">
				<input type="text" name="config_stage_width" value="<?php echo $config_stage_width; ?>" placeholder="<?php echo $entry_stage_width; ?>" class="form-control" />
			</div>
		</div>
		
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_stage_height; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_stage_height;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-2">
				<input type="text" name="config_stage_height" value="<?php echo $config_stage_height; ?>" placeholder="<?php echo $entry_stage_height; ?>" class="form-control" />
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_stage_max_width; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_stage_max_width;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-2">
				<input type="text" name="config_stage_max_width" value="<?php echo $config_stage_max_width; ?>" placeholder="<?php echo $entry_stage_max_width; ?>" class="form-control" />
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_view_all_design; ?>:</label>
			<div class="col-sm-3">
				<?php if($config_view_all_design){?>
					<input type="checkbox" name="config_view_all_design" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_view_all_design" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_show_popup_view; ?>:</label>
			<div class="col-sm-3">
				<?php if($config_show_popup_view){?>
					<input type="checkbox" name="config_show_popup_view" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_show_popup_view" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_view_selection_float; ?>:</label>
			<div class="col-sm-3">
				<?php if($config_view_selection_float){?>
					<input type="checkbox" name="config_view_selection_float" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_view_selection_float" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_view_tooltip; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_view_tooltip){?>
					<input type="checkbox" name="config_view_tooltip" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_view_tooltip" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_responsive; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_responsive){?>
					<input type="checkbox" name="config_responsive" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_responsive" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_allow_product_saving; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_allow_product_saving){?>
					<input type="checkbox" name="config_allow_product_saving" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_allow_product_saving" />
				<?php }?>
				
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_download_image; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_download_image){?>
					<input type="checkbox" name="config_download_image" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_download_image" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_pdf_button; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_pdf_button){?>
					<input type="checkbox" name="config_pdf_button" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_pdf_button" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_print_button; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_print_button){?>
					<input type="checkbox" name="config_print_button" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_print_button" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_center_in_bounding_box; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_center_in_bounding_box){?>
					<input type="checkbox" name="config_center_in_bounding_box" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_center_in_bounding_box" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_upload_designs; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_upload_designs){?>
					<input type="checkbox" name="config_upload_designs" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_upload_designs" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_upload_text; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_upload_text){?>
					<input type="checkbox" name="config_upload_text" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_upload_text" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_reset_table; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_reset_table){?>
					<input type="checkbox" name="config_reset_table" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_reset_table" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_fonts_dropdown; ?>:</label>
			<div class="col-sm-9">
				<?php if($config_font_dropdown){?>
					<input type="checkbox" name="config_font_dropdown" checked="checked" />
				<?php } else {?>
					<input type="checkbox" name="config_font_dropdown" />
				<?php }?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_zoom; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_zoom;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-2">
				<input type="text" name="config_zoom" value="<?php echo $config_zoom; ?>" placeholder="<?php echo $entry_zoom; ?>" class="form-control" />
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_zoom_min; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_zoom_min;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-2">
				<input type="text" name="config_zoom_min" value="<?php echo $config_zoom_min; ?>" placeholder="<?php echo $entry_zoom_min; ?>" class="form-control" />
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_zoom_max; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_zoom_max;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-2">
				<input type="text" name="config_zoom_max" value="<?php echo $config_zoom_max; ?>" placeholder="<?php echo $entry_zoom_max; ?>" class="form-control" />
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_facebook_app_id; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_facebook_app_id;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-9">
				<input type="text" name="config_facebook_app_id" value="<?php echo $config_facebook_app_id; ?>" placeholder="<?php echo $entry_facebook_app_id; ?>" class="form-control" />
			</div>
		</div>
		
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_instagram_client_id; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_instagram_client_id;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-9">
				<input type="text" name="config_instagram_client_id" value="<?php echo $config_instagram_client_id; ?>" placeholder="<?php echo $entry_instagram_client_id; ?>" class="form-control" />
			</div>
		</div><div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_instagram_redirect_uri; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_instagram_redirect_uri;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-9">
				<input type="text" name="config_instagram_redirect_uri" value="<?php echo $config_instagram_redirect_uri; ?>" placeholder="<?php echo $entry_instagram_redirect_uri; ?>" class="form-control" />
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_selected_color; ?>:</label>
			<div class="col-sm-1">
				<input type="text" name="config_selected_color" value="<?php echo $config_selected_color; ?>" placeholder="<?php echo $entry_selected_color; ?>" class="form-control color {hash:true}" />
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_bounding_color; ?>:</label>
			<div class="col-sm-1">
				<input type="text" name="config_bounding_color" value="<?php echo $config_bounding_color; ?>" placeholder="<?php echo $entry_bounding_color; ?>" class="form-control color {hash:true}" />
			</div>
		</div><div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_out_boundary_color; ?>:</label>
			<div class="col-sm-1">
				<input type="text" name="config_out_boundary_color" value="<?php echo $config_out_boundary_color; ?>" placeholder="<?php echo $entry_selected_color; ?>" class="form-control color {hash:true}" />
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_config_color_sidebar; ?>:</label>
			<div class="col-sm-1">
				<input type="text" name="config_color_sidebar" value="<?php echo $config_color_sidebar; ?>" placeholder="<?php echo $entry_config_color_sidebar; ?>" class="form-control color {hash:true}" />
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_config_color_icon; ?>:</label>
			<div class="col-sm-1">
				<input type="text" name="config_color_icon" value="<?php echo $config_color_icon; ?>" placeholder="<?php echo $entry_config_color_icon; ?>" class="form-control color {hash:true}" />
			</div>
		</div>
		</div>
		<div id="design" class="tab-pane">		
		<h4><?php echo $text_design_upload_image;?></h4>
		<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_x; ?></label>
				<div class="col-sm-3">
					<input type="text" name="config_designs_parameter_x" value="<?php echo $config_designs_parameter_x; ?>" placeholder="<?php echo $entry_designs_parameter_x; ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_y; ?></label>
				<div class="col-sm-3">
					<input type="text" name="config_designs_parameter_y" value="<?php echo $config_designs_parameter_y; ?>" placeholder="<?php echo $entry_designs_parameter_y; ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_z; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_designs_parameter_z;?>" width="16" height="16" src="view/image/help.png"></label>
				<div class="col-sm-3">
					<input type="text" name="config_designs_parameter_z" value="<?php echo $config_designs_parameter_z; ?>" placeholder="<?php echo $entry_designs_parameter_z; ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_colors; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_designs_parameter_colors;?>" width="16" height="16" src="view/image/help.png"></label>
				<div class="col-sm-1">
					<input type="text" name="config_designs_parameter_colors" value="<?php echo $config_designs_parameter_colors; ?>" placeholder="<?php echo $entry_designs_parameter_colors; ?>" class="form-control color {hash:true}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_price; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_designs_parameter_price;?>" width="16" height="16" src="view/image/help.png"></label>
				<div class="col-sm-1">
					<input type="text" name="config_designs_parameter_price" value="<?php echo $config_designs_parameter_price; ?>" placeholder="<?php echo $entry_designs_parameter_price; ?>" class="form-control" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_auto_center; ?></label>
				<div class="col-sm-9 ">
					<?php if($config_designs_parameter_auto_center){?>
						<input type="radio" name="config_designs_parameter_auto_center" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_auto_center" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_parameter_auto_center" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_auto_center" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
						<!--<label class="col-sm-6 control-label"><?php echo $description_designs_parameter_auto_center;?></label> -->
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_draggable; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_parameter_draggable){?>
						<input type="radio" name="config_designs_parameter_draggable" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_draggable" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_parameter_draggable" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_draggable" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_rotatable; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_parameter_rotatable){?>
						<input type="radio" name="config_designs_parameter_rotatable" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_rotatable" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_parameter_rotatable" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_rotatable" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_resizable; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_parameter_resizable){?>
						<input type="radio" name="config_designs_parameter_resizable" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_resizable" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_parameter_resizable" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_resizable" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_zchangeable; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_parameter_zchangeable){?>
						<input type="radio" name="config_designs_parameter_zchangeable" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_zchangeable" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_parameter_zchangeable" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_zchangeable" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_remove; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_parameter_remove){?>
						<input type="radio" name="config_designs_parameter_remove" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_remove" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_parameter_remove" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_remove" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_autoselect; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_parameter_autoselect){?>
						<input type="radio" name="config_designs_parameter_autoselect" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_autoselect" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_parameter_autoselect" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_autoselect" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div><div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_replace; ?></label>				
				<div class="col-sm-2">
					<input type="text" name="config_designs_parameter_replace" value="<?php echo $config_designs_parameter_replace; ?>" placeholder="<?php echo $entry_designs_replace; ?>" class="form-control" />
				</div>
			</div><div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_clipping; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_parameter_clipping){?>
						<input type="radio" name="config_designs_parameter_clipping" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_clipping" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_parameter_clipping" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_clipping" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_bounding_box; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_parameter_bounding_box){?>
						<input type="radio" name="config_designs_parameter_bounding_box" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_bounding_box" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_parameter_bounding_box" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_parameter_bounding_box" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_bounding_box_target; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_bounding_box_target;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_bounding_box_target" value="<?php echo $config_bounding_box_target; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
			<label class="col-sm-3 control-label"><?php echo $entry_bounding_box_x; ?></label>
			<div class="col-sm-3">
				<input type="text" name="config_bounding_box_x" value="<?php echo $config_bounding_box_x; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_bounding_box_y; ?></label>
			<div class="col-sm-3">
				<input type="text" name="config_bounding_box_y" value="<?php echo $config_bounding_box_y; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_bounding_box_width; ?></label>
			<div class="col-sm-3">
				<input type="text" name="config_bounding_box_width" value="<?php echo $config_bounding_box_width; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_bounding_box_height; ?></label>
			<div class="col-sm-3">
				<input type="text" name="config_bounding_box_height" value="<?php echo $config_bounding_box_height; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_min_width; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_min_width;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_min_width" value="<?php echo $config_min_width; ?>" placeholder="100" class="form-control"  />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_min_height; ?><img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_min_height;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_min_height" value="<?php echo $config_min_height; ?>" placeholder="100" class="form-control"  />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_max_width; ?><img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_max_width;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_max_width" value="<?php echo $config_max_width; ?>" placeholder="<?php echo $config_max_width;?>" class="form-control"  />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_max_height; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_max_height;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_max_height" value="<?php echo $config_max_height; ?>" placeholder="<?php echo $config_max_height;?>" class="form-control"  />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_resize_width; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_resize_width;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_resize_width" value="<?php echo $config_resize_width; ?>" placeholder="<?php echo $config_resize_width;?>" class="form-control"  />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_resize_height; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_resize_height;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_resize_height" value="<?php echo $config_resize_height; ?>" placeholder="<?php echo $config_resize_height;?>" class="form-control"  />
			</div>
			</div>
			</div>
			<div id="custom" class="tab-pane">			
			<h4><?php echo $text_cumstom;?> </h4>			
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_text_x_position; ?></label>
			<div class="col-sm-3">
				<input type="text" name="config_text_x_position" value="<?php echo $config_text_x_position; ?>" placeholder="<?php echo $config_text_x_position; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_y; ?></label>
			<div class="col-sm-3">
				<input type="text" name="config_text_y_position" value="<?php echo $config_text_y_position; ?>" placeholder="<?php echo $config_text_y_position; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_z; ?><img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_designs_parameter_z;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_text_z_position" value="<?php echo $config_text_z_position; ?>" placeholder="<?php echo $config_text_z_position; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_colors; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_designs_parameter_colors;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-1 ">
				<input type="text" name="config_text_design_color" value="<?php echo $config_text_design_color; ?>" placeholder="<?php echo $config_text_design_color; ?>" class="form-control color {hash:true}" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_price; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_designs_parameter_price;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_text_design_price" value="<?php echo $config_text_design_price; ?>" placeholder="<?php echo $entry_designs_parameter_price; ?>" class="form-control" />
			</div>
			</div>										
		
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_auto_center; ?></label>
			<div class="col-sm-9">
				<?php if($config_text_auto_center){?>
					<input type="radio" name="config_text_auto_center" value="1" checked="checked" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_auto_center" value="0" />
					<?php echo $text_no; ?>
					<?php } else { ?>
					<input type="radio" name="config_text_auto_center" value="1" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_auto_center" value="0" checked="checked" />
					<?php echo $text_no; ?>
					<?php } ?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_draggable; ?></label>
			<div class="col-sm-9">
				<?php if($config_text_draggable){?>
					<input type="radio" name="config_text_draggable" value="1" checked="checked" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_draggable" value="0" />
					<?php echo $text_no; ?>
					<?php } else { ?>
					<input type="radio" name="config_text_draggable" value="1" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_draggable" value="0" checked="checked" />
					<?php echo $text_no; ?>
					<?php } ?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_rotatable; ?></label>
			<div class="col-sm-9">
				<?php if($config_text_rotatable){?>
					<input type="radio" name="config_text_rotatable" value="1" checked="checked" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_rotatable" value="0" />
					<?php echo $text_no; ?>
					<?php } else { ?>
					<input type="radio" name="config_text_rotatable" value="1" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_rotatable" value="0" checked="checked" />
					<?php echo $text_no; ?>
					<?php } ?>
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_resizable; ?></label>
			<div class="col-sm-9">
				<?php if($config_text_resizeable){?>
					<input type="radio" name="config_text_resizeable" value="1" checked="checked" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_resizeable" value="0" />
					<?php echo $text_no; ?>
					<?php } else { ?>
					<input type="radio" name="config_text_resizeable" value="1" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_resizeable" value="0" checked="checked" />
					<?php echo $text_no; ?>
					<?php } ?>
			</div>
		</div>		
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_zchangeable; ?></label>
			<div class="col-sm-9">
				<?php if($config_text_zchangeable){?>
					<input type="radio" name="config_text_zchangeable" value="1" checked="checked" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_zchangeable" value="0" />
					<?php echo $text_no; ?>
					<?php } else { ?>
					<input type="radio" name="config_text_zchangeable" value="1" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_zchangeable" value="0" checked="checked" />
					<?php echo $text_no; ?>
					<?php } ?>
			</div>
		</div>
		<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_replace; ?></label>				
				<div class="col-sm-2">
					<input type="text" name="config_text_replace" value="<?php echo $config_text_replace; ?>" placeholder="<?php echo $entry_designs_replace; ?>" class="form-control" />
				</div>
			</div>
		<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_designs_parameter_remove; ?></label>
			<div class="col-sm-9">
				<?php if($config_text_remove){?>
					<input type="radio" name="config_text_remove" value="1" checked="checked" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_remove" value="0" />
					<?php echo $text_no; ?>
					<?php } else { ?>
					<input type="radio" name="config_text_remove" value="1" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_remove" value="0" checked="checked" />
					<?php echo $text_no; ?>
					<?php } ?>
			</div>
		</div>	
		<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_autoselect; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_text_autoselect){?>
						<input type="radio" name="config_designs_text_autoselect" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_text_autoselect" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_text_autoselect" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_text_autoselect" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div><div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_clipping; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_text_clipping){?>
						<input type="radio" name="config_designs_text_clipping" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_text_clipping" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_text_clipping" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_text_clipping" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_designs_bounding_box; ?></label>
				<div class="col-sm-9">
					<?php if($config_designs_text_bounding_box){?>
						<input type="radio" name="config_designs_text_bounding_box" value="1" checked="checked" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_text_bounding_box" value="0" />
						<?php echo $text_no; ?>
						<?php } else { ?>
						<input type="radio" name="config_designs_text_bounding_box" value="1" />
						<?php echo $text_yes; ?>
						<input type="radio" name="config_designs_text_bounding_box" value="0" checked="checked" />
						<?php echo $text_no; ?>
						<?php } ?>
				</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_bounding_box_target; ?> <img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_bounding_box_target;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_text_bounding_box_target" value="<?php echo $config_text_bounding_box_target; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_text_bounding_x_position; ?></label>
			<div class="col-sm-3">
				<input type="text" name="config_text_bounding_x_position" value="<?php echo $config_text_bounding_x_position; ?>" placeholder="<?php echo $config_text_bounding_x_position; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_bounding_box_y; ?></label>
			<div class="col-sm-3">
				<input type="text" name="config_text_bounding_y_position" value="<?php echo $config_text_bounding_y_position; ?>" placeholder="<?php echo $config_text_bounding_y_position; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_bounding_box_width; ?></label>
			<div class="col-sm-3">
				<input type="text" name="config_text_bounding_width" value="<?php echo $config_text_bounding_width; ?>" placeholder="<?php echo $config_text_bounding_width; ?>" class="form-control" />
			</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_bounding_box_height; ?></label>
			<div class="col-sm-3">
				<input type="text" name="config_text_bounding_height" value="<?php echo $config_text_bounding_height; ?>" placeholder="<?php echo $config_text_bounding_height; ?>" class="form-control" />
			</div>
			</div>		
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_text_patternable; ?><img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_text_patternable;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-9">
				<?php if($config_text_patternable){?>
					<input type="radio" name="config_text_patternable" value="1" checked="checked" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_patternable" value="0" />
					<?php echo $text_no; ?>
					<?php } else { ?>
					<input type="radio" name="config_text_patternable" value="1" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_patternable" value="0" checked="checked" />
					<?php echo $text_no; ?>
					<?php } ?>
				   <a class="btn btn-primary" onclick="image_upload('image', 'thumb');" data-toggle="tooltip" title="<?php echo $text_image_manager;?>"><?php echo $text_image_manager;?></a>
			</div>
			
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_text_curved; ?><img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_text_curved;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-9">
				<?php if($config_text_curved){?>
					<input type="radio" name="config_text_curved" value="1" checked="checked" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_curved" value="0" />
					<?php echo $text_no; ?>
					<?php } else { ?>
					<input type="radio" name="config_text_curved" value="1" />
					<?php echo $text_yes; ?>
					<input type="radio" name="config_text_curved" value="0" checked="checked" />
					<?php echo $text_no; ?>
					<?php } ?>
			</div>
			</div>				
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_default_text_size; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_default_text_size;?>" width="16" height="16" src="view/image/help.png"></label>
				<div class="col-sm-3">
					<input type="text" name="config_default_text_size" value="<?php echo $config_default_text_size; ?>" placeholder="<?php echo $entry_default_text_size; ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label"><?php echo $entry_config_text_default; ?>: <img class="help_tip" data-toggle="tooltip" title="<?php echo $help_default_text;?>" width="16" height="16" src="view/image/help.png"></label>
				<div class="col-sm-3">
					<input type="text" name="config_text_default" value="<?php echo $config_text_default; ?>" placeholder="<?php echo $entry_config_text_default; ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_text_characters; ?><img class="help_tip pull-right" data-toggle="tooltip" title="<?php echo $help_text_characters;?>" width="16" height="16" src="view/image/help.png"></label>
			<div class="col-sm-3">
				<input type="text" name="config_text_text_characters" value="<?php echo $config_text_text_characters; ?>" placeholder="<?php echo $entry_text_characters; ?>" class="form-control" />
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

<?php echo $footer; ?>