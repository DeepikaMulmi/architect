<?php

if ( ! function_exists( 'emaurri_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function emaurri_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'emaurri_filter_mobile_header_template', emaurri_get_template_part( 'mobile-header', 'templates/mobile-header' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	add_action( 'emaurri_action_page_header_template', 'emaurri_load_page_mobile_header' );
}

if ( ! function_exists( 'emaurri_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function emaurri_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'emaurri_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'emaurri' ) ) );

		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}

	add_action( 'emaurri_action_after_include_modules', 'emaurri_register_mobile_navigation_menus' );
}
