<?php do_action( 'emaurri_action_before_page_header' ); ?>

<header id="qodef-page-header">
	<div id="qodef-page-header-inner" class="<?php echo implode( ' ', apply_filters( 'emaurri_filter_header_inner_class', array(), 'default' ) ); ?>">
		<div class="qodef-vertical-sliding-area qodef--static">
			<?php
			// include logo
			emaurri_core_get_header_logo_image();

			// include opener
			emaurri_core_get_opener_icon_html(
				array(
					'option_name'  => 'vertical_sliding_menu',
					'custom_class' => 'qodef-vertical-sliding-menu-opener',
				),
				true
			);

			// include widget area one
			emaurri_core_get_header_widget_area();
			?>
		</div>
		<div class="qodef-vertical-sliding-area qodef--dynamic">
			<?php
			// include vertical sliding navigation
			emaurri_core_template_part( 'header', 'layouts/vertical-sliding/templates/navigation' );

			// include widget area two
			emaurri_core_get_header_widget_area( '', 'two' );
			?>
		</div>
	</div>
</header>
