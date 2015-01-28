
		<?php if ($options) { ?>  
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
			  <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
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
		  <?php } ?>