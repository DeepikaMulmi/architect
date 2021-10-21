<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_single_variation_images_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_single_variation_images_big( $variations ) {
		$variations['images-big'] = esc_html__( 'Images - Big', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_portfolio_single_layout_options', 'emaurri_core_add_portfolio_single_variation_images_big' );
}

if ( ! function_exists( 'emaurri_core_set_default_portfolio_single_variation_compact' ) ) {
	/**
	 * Function that set default variation layout for current module
	 *
	 * @return string
	 */
	function emaurri_core_set_default_portfolio_single_variation_compact() {
		return 'images-big';
	}

	add_filter( 'emaurri_core_filter_portfolio_single_layout_default_value', 'emaurri_core_set_default_portfolio_single_variation_compact' );
}
