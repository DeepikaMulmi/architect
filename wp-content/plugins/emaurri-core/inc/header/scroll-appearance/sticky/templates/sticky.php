<div class="qodef-header-sticky qodef-custom-header-layout <?php echo implode( ' ', apply_filters( 'emaurri_core_filter_sticky_header_class', array() ) ); ?>">
	<div class="qodef-header-sticky-inner <?php echo implode( ' ', apply_filters( 'emaurri_filter_header_inner_class', array(), 'sticky' ) ); ?>">
		<?php
		// Include logo
		emaurri_core_get_header_logo_image( array( 'sticky_logo' => true ) );

		// Include main navigation
		emaurri_core_template_part( 'header', 'templates/parts/navigation', '', array( 'menu_id' => 'qodef-sticky-navigation-menu' ) );

		// Include widget area one
		if ( is_active_sidebar( 'qodef-sticky-header-widget-area-one' ) ) {
			?>
			<div class="qodef-widget-holder qodef--one">
				<?php emaurri_core_get_header_widget_area( 'sticky' ); ?>
			</div>
			<?php
		}

		do_action( 'emaurri_core_action_after_sticky_header' );
		?>
	</div>
</div>
