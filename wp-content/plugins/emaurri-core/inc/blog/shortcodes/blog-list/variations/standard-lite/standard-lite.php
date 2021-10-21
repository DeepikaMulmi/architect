<?php

if ( ! function_exists( 'emaurri_core_add_blog_list_variation_standard_lite' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_blog_list_variation_standard_lite( $variations ) {
		$variations['standard-lite'] = esc_html__( 'Standard Lite', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_blog_list_layouts', 'emaurri_core_add_blog_list_variation_standard_lite' );
}

if ( ! function_exists( 'emaurri_core_load_blog_list_variation_standard_assets' ) ) {
	/**
	 * Function that return is global blog asses allowed for variation layout
	 *
	 * @param bool $is_enabled
	 * @param array $params
	 *
	 * @return bool
	 */
	function emaurri_core_add_blog_list_variation_standard_lite_assets( $is_enabled, $params ) {

		if ( 'standard-lite' === $params['layout'] ) {
			$is_enabled = true;
		}

		return $is_enabled;
	}

	add_filter( 'emaurri_core_filter_load_blog_list_assets', 'emaurri_core_add_blog_list_variation_standard_lite_assets', 10, 2 );
}

if ( ! function_exists( 'emaurri_core_register_blog_list_standard_lite_scripts' ) ) {
	/**
	 * Function that register modules 3rd party scripts
	 *
	 * @param array $scripts
	 *
	 * @return array
	 */
	function emaurri_core_register_blog_list_standard_lite_scripts( $scripts ) {

		$scripts['wp-mediaelement']    = array(
			'registered' => true,
		);
		$scripts['mediaelement-vimeo'] = array(
			'registered' => true,
		);

		return $scripts;
	}

	add_filter( 'emaurri_core_filter_blog_list_register_scripts', 'emaurri_core_register_blog_list_standard_lite_scripts' );
}

if ( ! function_exists( 'emaurri_core_register_blog_list_standard_lite_styles' ) ) {
	/**
	 * Function that register modules 3rd party scripts
	 *
	 * @param array $styles
	 *
	 * @return array
	 */
	function emaurri_core_register_blog_list_standard_lite_styles( $styles ) {

		$styles['wp-mediaelement'] = array(
			'registered' => true,
		);

		return $styles;
	}

	add_filter( 'emaurri_core_filter_blog_list_register_styles', 'emaurri_core_register_blog_list_standard_lite_styles' );
}
