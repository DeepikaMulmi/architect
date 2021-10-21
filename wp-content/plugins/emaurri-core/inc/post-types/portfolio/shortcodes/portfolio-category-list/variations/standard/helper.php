<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_category_list_variation_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_category_list_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_portfolio_category_list_layouts', 'emaurri_core_add_portfolio_category_list_variation_standard' );
}
