<section class="fpd-sidebar fpd-border-color fpd-secondary-bg-color fpd-clearfix">
	
	<!-- Navigation -->
	<div class="fpd-navigation fpd-primary-bg-color">
		<a class="fpd-nav-item fpd-secondary-text-color fpd-tooltip" data-target=".fpd-products" title="<?php echo $choose_products_menu; ?>"><i class="fa fa-book icon"></i><span><?php echo $products_menu; ?></span></a>
		<a class="fpd-nav-item fpd-secondary-text-color fpd-tooltip" data-target=".fpd-designs" title="<?php echo $choose_designs_menu; ?>"><i class="fa fa-folder-open icon"></i><span><?php echo $designs_menu; ?></span></a>
		<a class="fpd-nav-item fpd-secondary-text-color fpd-tooltip" data-target=".fpd-edit-elements" title="<?php echo $edit_elements_menu; ?>"><i class="fa fa-edit icon"></i><span><?php echo $elements_menu; ?></span></a>
		<a class="fpd-nav-item fpd-secondary-text-color fpd-tooltip" data-target=".fpd-user-photos" title="<?php echo $user_photos_menu; ?>"><i class="fa fa-photo icon"></i><span><?php echo $photos_menu; ?></span></a>
	<!--	<a class="fpd-nav-item fpd-secondary-text-color fpd-tooltip" data-target=".fpd-instagram-photos" title="<?php echo $insta_photos_menu; ?>"><i class="fa fa-instagram icon"></i><span>Instagram</span></a>-->
	</div>
	<!-- Content -->
	<div class="fpd-content fpd-primary-text-color">
		<!-- Products -->
		<div class="fpd-products">
			 <div class="fpd-navigation-product fpd-primary-bg-color">
				<a class="fpd-nav-item fpd-secondary-text-color fpd-tooltip" data-target=".element-product-design" title="<?php echo $products_menu; ?>"><i class="fa fa-book icon"></i> <span> <?php echo $products_menu; ?></span></a>
				<a class="fpd-nav-item fpd-secondary-text-color fpd-tooltip" data-target=".element-product-ideas" title="Product Design Ideas"><i class="fa fa-eye icon"></i> <span> <?php echo $products_ideas; ?></span></a>
			</div>
			<div class="fpd-items-wrapper fpd-border-color fpd-clearfix"></div>
		</div>
		<!-- Designs -->	
		<div class="fpd-designs">
			<div class="fpd-items-wrapper fpd-border-color fpd-clearfix"></div>
		</div>
		<!-- Edit elements -->
		<div class="fpd-edit-elements">
			<h3><?php echo $edit_elements_headline; ?></h3>
			<div class="fpd-elements-dropdown-wrapper">
				<select class="fpd-elements-dropdown">
					<option value="none"><?php echo $edit_elements_dropdown_none; ?></option>
				</select>
			</div>
			<!-- Toolbar -->
			<div class="fpd-toolbar fpd-clearfix">
				<div class="fpd-filling-wrapper">
					<h5><?php echo $section_filling; ?></h5>
					<div class="fpd-color-picker fpd-border-color">
						<input type="text" value="">
					</div>
					<div class="fpd-patterns-wrapper fpd-border-color">
						<div class="fpd-pattern-items fpd-clearfix"></div>
					</div>
				</div>
				<div class="fpd-text-format-section">
					<h5><?php echo $section_fonts_styles; ?></h5>
					<div>
						<textarea class="fpd-border-color"></textarea>
					</div>
					<div class="fpd-fonts-dropdown-wrapper">
						<select class="fpd-fonts-dropdown"></select>
					</div>
					<div class="fpd-text-styles">
						<button title="<?php echo $customize_text_align_left; ?>" class="fpd-align-left fpd-button fpd-tooltip"><i class="fa fa-align-left icon"></i></button>
						<button title="<?php echo $customize_text_align_center; ?>" class="fpd-align-center fpd-button fpd-tooltip"><span class="fa fa-align-center icon"></i></button>
						<button title="<?php echo $customize_text_align_right; ?>" class="fpd-align-right fpd-button fpd-tooltip"><i class="fa fa-align-right icon"></i></button>
						<button title="<?php echo $customize_text_bold; ?>" class="fpd-bold fpd-button fpd-tooltip"><i class="fa fa-bold icon"></i></button>
						<button title="<?php echo $customize_text_italic; ?>" class="fpd-italic fpd-button fpd-tooltip"><i class="fa fa-italic icon"></i></button>
					</div>
				</div>
				<div class="fpd-curved-text-wrapper">
					<h5><?php echo $section_curved_text; ?> <i class="fa fa-question-circle fpd-tooltip fpd-help-icon" title="<?php echo $curved_text_info; ?>"></i></h5>
					<div>
						<button title="<?php echo $curved_text_toggle; ?>" class="fpd-curve-toggle fpd-button fpd-button-submit fpd-tooltip"><i class="fa fa-check icon"></i></button>
						<button title="<?php echo $curved_text_reverse; ?>" class="fpd-curve-reverse fpd-curve-toggle-item fpd-button fpd-tooltip"><i class="fa fa-text-width icon"></i></button>
					</div>
					<div class="fpd-curve-toggle-item">
						<div class="fpd-clearfix fpd-input-group">
							<label><?php echo $curved_text_radius; ?></label>
							<input type="range" min="0" max="200" value="100" class="fpd-curved-text-radius" />
						</div>
						<div class="fpd-clearfix fpd-input-group">
							<label><?php echo $curved_text_spacing; ?></label>
							<input type="range" min="0" max="100" value="50" class="fpd-curved-text-spacing" />
						</div>
					</div>
				</div>
				<div class="fpd-helper-buttons-wrapper">
					<h5><?php echo $section_helpers; ?></h5>
					<button title="<?php echo $customize_center_h; ?>" class="fpd-center-horizontal fpd-button fpd-tooltip"><i class="fa fa-arrows-h icon"></i></button>
					<button title="<?php echo $customize_center_c; ?>" class="fpd-center-vertical fpd-button fpd-tooltip"><i class="fa fa-arrows-v icon"></i></button>
					<button title="<?php echo $customize_center_move_down; ?>" class="fpd-move-down fpd-button fpd-tooltip"><i class="fa fa-arrow-down icon"></i></button>
					<button title="<?php echo $customize_center_move_up; ?>" class="fpd-move-up fpd-button fpd-tooltip"><i class="fa fa-arrow-up icon"></i></button>
					<button title="<?php echo $customize_reset; ?>" class="fpd-reset fpd-button fpd-tooltip"><i class="fa fa-refresh icon"></i></button>
				</div>
			</div>
		</div>
		<!-- Products Ideas-->
		<div class="fpd-products-ideas">
			 <h3><?php echo $text_select_product; ?></h3>
			<div class="fpd-items-wrapper fpd-border-color fpd-clearfix"></div>
		</div>
		<div class="fpd-user-photos">
			<div class="fpd-navigation-upload fpd-primary-bg-color">
				<a class="fpd-nav-item fpd-secondary-text-color fpd-tooltip" data-target=".fpd-fb-user-photos" title="<?php echo $fb_photos_menu; ?>"><i class="fa fa-facebook icon"></i><span> <?php echo $fb_photos; ?></span></a>
				<a class="fpd-nav-item fpd-secondary-text-color fpd-tooltip" data-target=".fpd-instagram-photos" title="<?php echo $insta_photos_menu; ?>"><i class="fa fa-instagram icon"></i><span> <?php echo $insta_photos; ?></span></a>
			</div>
			<div class="fpd-items-wrapper fpd-border-color fpd-clearfix">
				<!-- Facebook User Photos -->
				<div class="fpd-fb-user-photos">
					<div class="fpd-fb-head fpd-clearfix">
						<h3><?php echo $fb_photos_headline; ?></h3>
						<div class="fpd-clearfix">
							<div class="fpd-fb-loader fpd-clearfix">
								<fb:login-button data-max-rows="1" data-show-faces="false" data-scope="user_photos" autologoutlink="true"></fb:login-button>
								<span class="fpd-loading-gif"></span>
							</div>
							<select class="fpd-fb-user-albums">
								<option selected="selected" disabled="disabled"><?php echo $fb_select_album; ?></option>
							</select>
						</div>
					</div>
					<div class="fpd-items-wrapper fpd-border-color fpd-clearfix"></div>
				</div>
				<!-- Facebook User Photos -->
				<div class="fpd-instagram-photos">
					<div class="fpd-insta-head">
						<h3><?php echo $insta_photos_headline; ?></h3>
						<div>
							<button class="fpd-insta-feed fpd-button-submit fpd-button fpd-submit"><?php echo $insta_feed_button; ?></button>
							<button class="fpd-insta-recent-images fpd-button-submit fpd-button fpd-submit"><?php echo $insta_recent_images_button; ?></button>
							<p class="fpd-insta-load-next disabled"><?php echo $insta_load_next; ?></p>
						</div>
					</div>
					<div class="fpd-items-wrapper fpd-border-color fpd-clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</section>