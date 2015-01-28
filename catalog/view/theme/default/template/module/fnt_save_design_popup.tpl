<div id="content">
  <h1><?php echo $title_heading; ?></h1>
	<div class="warning"></div>
    <div class="content">
      <table class="form">
        <tr>
          <td><?php echo $entry_name; ?></td>
          <td><input type="text" name="name_design" value="" /></td>
        </tr>
      </table>
    </div>
    <div class="buttons">
      <div class="right">
        <span class="button"><input id="formlogin" type="submit" value="<?php echo $button_continue; ?>" class="button" /></span>
      </div>
    </div>
<script type="text/javascript"><!--
	$('.warning').css('opacity','0');
	$('#formlogin').click(function() {
		if($('input[name=\'name_design\']').val() == ''){
			$('.warning').html('Product design name is not null!');
			$('.warning').css('opacity','1');
		} else {
			$.ajax({
				url: 'index.php?route=product/fnt_category_product_design/saveCustomDesignIdea',
				type: 'post',
				data: 'name_design='+$('input[name=\'name_design\']').val(),
				dataType: 'json',
				success: function (json) {
					$.colorbox.close();
				}
			});	
		}
	});
//--></script> 

</div>
