<?php

if ( ! function_exists( 'emaurri_register_justified_gallery_scripts' ) ) {
	/**
	 * Function that register module 3rd party scripts
	 */
	function emaurri_register_justified_gallery_scripts() {
		wp_register_script( 'jquery-justified-gallery', EMAURRI_INC_ROOT . '/justified-gallery/assets/js/plugins/jquery.justifiedGallery.min.js', array( 'jquery' ), true );
	}

	add_action( 'emaurri_action_before_main_js', 'emaurri_register_justified_gallery_scripts' );
}

if ( ! function_exists( 'emaurri_include_justified_gallery_scripts' ) ) {
	/**
	 * Function that enqueue modules 3rd party scripts
	 *
	 * @param array $atts
	 */
	function emaurri_include_justified_gallery_scripts( $atts ) {

		if ( isset( $atts['behavior'] ) && 'justified-gallery' === $atts['behavior'] ) {
			wp_enqueue_script( 'jquery-justified-gallery' );
		}
	}

	add_action( 'emaurri_core_action_list_shortcodes_load_assets', 'emaurri_include_justified_gallery_scripts' );
}

if ( ! function_exists( 'emaurri_register_justified_gallery_scripts_for_list_shortcodes' ) ) {
	/**
	 * Function that set module 3rd party scripts for list shortcodes
	 *
	 * @param array $scripts
	 *
	 * @return array
	 */
	function emaurri_register_justified_gallery_scripts_for_list_shortcodes( $scripts ) {

		$scripts['jquery-justified-gallery'] = array(
			'registered' => true,
		);

		return $scripts;
	}

	add_filter( 'emaurri_core_filter_register_list_shortcode_scripts', 'emaurri_register_justified_gallery_scripts_for_list_shortcodes' );
}
