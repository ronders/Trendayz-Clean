<?php echo $header;?>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: 'Image Manager',
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
    	<div id="content">
			<ul class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
			<?php } ?>
		  </ul>
			<div class="page-header">
			<div class="container-fluid">
			  <div class="pull-right">
				<button type="submit" id="button-submit"  data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary" onclick="$('#form-product').submit();"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
				<h1 class="panel-title"><i class="fa fa-pencil-square fa-lg"></i> <?php echo $heading_title;?></h1>
			</div>
			</div>
			<div class="container-fluid">				
			  <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="panel-body">
			  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
			<div class="form-group">
              <label class="col-sm-2 control-label" for="input-name">Name</label>
              <div class="col-sm-10">
                <input type="text" name="name" value="<?php echo $name;?>" placeholder="Name" id="input-name" class="form-control" />
              </div>
            </div>
			<div class="form-group">
			  <label class="col-sm-2 control-label" for="input-image">Image</label>
              <div class="col-sm-10">
             <img src="<?php echo $thumb;?>" alt="" id="thumb" /><br />
                  <input type="hidden" name="image" value="<?php echo $image;?>" id="image" />
                  <a onclick="image_upload('image', 'thumb');">Browse</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');">Clear</a>
              </div>
			</div>
			<div class="form-group">
			  <label class="col-sm-2 control-label"> Approve Status:</label>
              <div class="col-sm-10">
				<select name="status">
					<?php if($status){?>
						<option value="1" selected="selected">Enabled</option>
						<option value="0">Disabled</option>
					<?php } else {?>
						<option value="1">Enabled</option>
						<option value="0" selected="selected">Disabled</option>
					<?php }?>	
				</select>
            </div>
			</div>
					
                <input type="hidden" name="product_customer_idea_id" value="<?php echo $product_customer_idea_id;?>" />
				<?php if(isset($product_customer_idea_accept_id)){?>
					<input type="hidden" name="product_customer_idea_accept_id" value="<?php echo $product_customer_idea_accept_id;?>" />
				<?php }?>
                <input type="hidden" name="product_design_id" value="<?php echo $product_design_id;?>" />
                <input type="hidden" name="customer_id" value="<?php echo $customer_id;?>" />
				</form>			
		  	<br />
			
		  	<!-- The form recreation -->
		  	<input type="file" id="design-upload" style="display: none;" />
		  	<input type="hidden" value="<?php echo $dir_image;?>" name="dir_image" id="dir_image"/>
    	</div>
		</div>
	  </div>
	 </div>
	<?php echo $footer;?>	
	