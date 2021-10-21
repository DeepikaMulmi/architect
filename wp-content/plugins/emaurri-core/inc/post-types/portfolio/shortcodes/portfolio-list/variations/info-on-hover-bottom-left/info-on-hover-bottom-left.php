<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_list_variation_info_on_hover_bottom_left' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_list_variation_info_on_hover_bottom_left( $variations ) {
		$variations['info-on-hover-bottom-left'] = esc_html__( 'Info On Hover Bottom Left', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_portfolio_list_layouts', 'emaurri_core_add_portfolio_list_variation_info_on_hover_bottom_left' );
}
