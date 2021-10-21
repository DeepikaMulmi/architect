<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_category_list_variation_gallery' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_category_list_variation_gallery( $variations ) {
		$variations['gallery'] = esc_html__( 'Gallery', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_portfolio_category_list_layouts', 'emaurri_core_add_portfolio_category_list_variation_gallery' );
}
