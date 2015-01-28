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
				<a onclick="saveProductAndDesign();" data-toggle="tooltip" title="<?php echo $button_save_design; ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_save_design; ?></a>				
				<button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
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
		<ul style="margin-bottom:25px;" class="nav nav-tabs">
		  <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>	
          <li><a href="#tab-data" data-toggle="tab"><?php echo $tab_data; ?></a></li>
		  <?php if (!isset($tab_insert)) { ?>
          <li><a href="#tab-image" data-toggle="tab"><?php echo $tab_view; ?></a></li>
		  <?php } ?>
        </ul>
      <div class="tab-content">
          <div class="tab-pane active" id="tab-general">
             <ul style="margin-bottom:25px;" class="nav nav-tabs" id="language">
              <?php foreach ($languages as $language) { ?>
              <li><a href="#language<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <?php foreach ($languages as $language) { ?>
              <div class="tab-pane" id="language<?php echo $language['language_id']; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-name<?php echo $language['language_id']; ?>"><?php echo $entry_name; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name<?php echo $language['language_id']; ?>" class="form-control" />
                    <?php if (isset($error_name[$language['language_id']])) { ?>
                    <div class="text-danger"><?php echo $error_name[$language['language_id']]; ?></div>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="tab-pane" id="tab-data">
			<div class="form-group">
              <label class="col-sm-2 control-label" for="input-product"><?php echo $entry_product; ?></label>
              <div class="col-sm-10">
				<?php if (isset($update)) { ?>
					<input type="text"  value="<?php echo $product ?>" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" readonly />
				<?php } else { ?>
                <input type="text" name="product" value="<?php echo $product ?>" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
				<?php } ?>
                <input type="hidden" name="product_design_id" value="<?php echo $product_design_id; ?>" />
                <span class="help-block"><?php echo $help_product; ?></span>
				 <?php if (isset($error_product_design)) { ?>
                    <div class="text-danger"><?php echo $error_product_design; ?></div>
                    <?php } ?>
				</div>
            </div>
			 <div class="form-group">
              <label class="col-sm-2 control-label" for="input-image"><?php echo $entry_image; ?></label>
              <div class="col-sm-10">
				<div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                  <br />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div>
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
		  <?php if (!isset($tab_insert)) { ?>
		  <div class="tab-pane" id="tab-image">
			<div class="table-responsive">
			<p class="toolbar text-right">
			<input type="file" value="Upload" class="fpd-hidden" id="fpd-file-import" />
				<a class="btn btn-primary" id="fpd-import"><?php echo $text_import;?></a>
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
                      <input type="hidden" name="product_image[<?php echo $image_row; ?>][product_ideas_element_id]" value="<?php echo $product_image['product_ideas_element_id']; ?>" /></td>
                    <td class="text-right"><input type="text" name="product_image[<?php echo $image_row; ?>][name]" value="<?php echo $product_image['name']; ?>" placeholder="<?php echo $entry_view_name; ?>" class="form-control" /></td>
                    <td class="text-left"><input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>
                    <td class="text-left">
						<a href="<?php echo $product_image['edit']; ?>" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_edit;?>"><i class="fa fa-edit"></i> <?php echo $button_edit; ?></a>
						<button type="button" onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="btn btn-danger" data-toggle="tooltip" title="<?php echo $button_remove; ?>"><i class="fa fa-minus-circle"></i> <?php echo $button_remove; ?></button>
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
		  <?php } ?>
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
			url: 'index.php?route=catalog/fnt_product_design/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				json.unshift({
					'product_design_id': 0,
					'name': '<?php echo $text_none; ?>'
				});
				
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_design_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'product\']').val(item['label']);
		$('input[name=\'product_design_id\']').val(item['value']);
	}	
});

function saveProductAndDesign() {
	var action = $('#form-product').attr('action') + '&design=1'
	$('#form-product').attr('action',action);
	$('#form-product').submit();
}
//--></script> 
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {	
	html  = '<tr id="image-row' + image_row + '">';	
	html += '  <td class="text-left"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></td>';
	
	html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][name]" value="" placeholder="<?php echo $entry_name; ?>" class="form-control" /></td>';
	
	html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" placeholder="<?php echo $entry_sort_order; ?>" class="form-control" /></td>';	
	
	html += '  <td class="text-left"><a href="<?php echo $product_image['edit']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i> <?php echo $button_edit; ?></a> <button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" class="btn btn-danger"><i class="fa fa-minus-circle"></i> <?php echo $button_remove; ?></button></td>';
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
<script type="text/javascript"><!--
$('#language a:first').tab('show');
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

		var urlAjaxExport = 'index.php?route=catalog/fnt_product_ideas/export&token=<?php echo $token; ?>&product_ideas_id=<?php echo $product_ideas_id;?>';
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
				url: 'index.php?route=catalog/fnt_product_ideas/import&token=<?php echo $token; ?>&product_ideas_id=<?php echo $product_ideas_id;?>',
				data: {
					elements: view.elements,
					thumbnail: view.thumbnail,
					title: view.title,
					thumbnail_name: view.thumbnail_name ? view.thumbnail_name : view.title,
					product_ideas_id: <?php echo $product_ideas_id;?>
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
</script>
<?php echo $footer; ?>