<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_single_variation_custom' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_single_variation_custom( $variations ) {
		$variations['custom'] = esc_html__( 'Custom', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_portfolio_single_layout_options', 'emaurri_core_add_portfolio_single_variation_custom' );
}
