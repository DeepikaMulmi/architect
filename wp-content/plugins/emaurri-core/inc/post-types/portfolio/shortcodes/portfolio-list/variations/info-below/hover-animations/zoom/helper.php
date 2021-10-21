<?php

if ( ! function_exists( 'emaurri_core_filter_portfolio_list_info_below_zoom' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_filter_portfolio_list_info_below_zoom( $variations ) {
		$variations['zoom'] = esc_html__( 'Zoom', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_portfolio_list_info_below_animation_options', 'emaurri_core_filter_portfolio_list_info_below_zoom' );
}
