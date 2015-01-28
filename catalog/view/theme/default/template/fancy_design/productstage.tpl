<section class="fpd-product-container fpd-border-color">
	<div class="fpd-menu-bar fpd-clearfix fpd-primary-bg-color fpd-secondary-text-color">
		<!-- Menu -->
		<div class="fpd-clearfix">
			<span class="fpd-add-image fpd-tooltip" title="<?php echo $add_image_tooltip; ?>"><i class="fa fa-image"><span><?php echo $text_add_image; ?></span></i></span>
			<span class="fpd-add-text fpd-tooltip" title="<?php echo $add_text_tooltip; ?>"><i class="fa fa-font"><span><?php echo $text_add_text; ?></span></i></span>
			<form class="fpd-upload-form" style="display: none;">
				<input type="file" class="fpd-input-image" name="uploaded_file"  />
			</form>
			</div>
		<div class="fpd-clearfix">
			<span class="fpd-zoom-in fpd-tooltip" title="<?php echo $zoom_in_tooltip; ?>"><i class="fa fa-search-plus"><span><?php echo $text_zoom_in; ?></span></i></span>
			<span class="fpd-zoom-out fpd-tooltip" title="<?php echo $zoom_out_tooltip; ?>"><i class="fa fa-search-minus"><span><?php echo $text_zoom_out; ?></span></i></span>
			<span class="fpd-zoom-reset fpd-tooltip" title="<?php echo $zoom_reset_tooltip; ?>"><i class="fa fa-search"><span><?php echo $text_zoom_reset; ?></span></i></span>
			<span class="fpd-download-image fpd-tooltip" title="<?php echo $download_image_tooltip; ?>"><i class="fa fa-cloud-download"><span><?php echo $text_download_image; ?></span></i></span>
			<span class="fpd-save-pdf fpd-tooltip" title="<?php echo $pdf_tooltip; ?>"><i class="fa fa-file-o"><span><?php echo $text_pdf; ?></span></i></span>
			<span class="fpd-print fpd-tooltip" title="<?php echo $print_tooltip; ?>"><i class="fa fa-print"><span><?php echo $text_print; ?></span></i></span>
			<span class="fpd-save-product fpd-tooltip" title="<?php echo $save_product_tooltip; ?>"><i class="fa fa-floppy-o"><span><?php echo $text_save_product; ?></span></i></span>
			<div class="fpd-saved-products fpd-border-color fpd-tooltip" title="<?php echo $saved_products_tooltip; ?>">
				<i class="fa fa-th-list"><span><?php echo $text_saved_products; ?></span></i>
				<div class="menu"></div>
			</div>
			<span class="fpd-reset-product fpd-tooltip" title="<?php echo $reset_tooltip; ?>"><i class="fa fa-refresh"><span><?php echo $text_reset; ?></span></i></span>
			<a href="" download="" target="_blank" class="fpd-download-anchor" style="display: none;"></a>
		</div>
	</div>
	<!-- Kinetic Stage -->
	<div class="fpd-product-stage fpd-border-color">
		<canvas></canvas>
		<div class="fpd-element-tooltip fpd-border-color fpd-secondary-bg-color fpd-primary-text-color"></div>
	</div>
</section>