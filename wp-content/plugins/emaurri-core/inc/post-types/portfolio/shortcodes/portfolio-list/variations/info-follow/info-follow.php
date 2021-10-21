<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_list_variation_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_list_variation_info_follow( $variations ) {
		$variations['info-follow'] = esc_html__( 'Info Follow', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_portfolio_list_layouts', 'emaurri_core_add_portfolio_list_variation_info_follow' );
}
