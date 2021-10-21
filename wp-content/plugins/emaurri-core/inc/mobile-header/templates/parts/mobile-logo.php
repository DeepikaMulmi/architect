<a itemprop="url" class="qodef-mobile-header-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php qode_framework_inline_style( $logo_height ); ?> rel="home">
	<?php echo qode_framework_wp_kses_html( 'img', $logo_main_image ); ?>
	<?php do_action( 'emaurri_core_after_mobile_header_logo_image' ); ?>
</a>
