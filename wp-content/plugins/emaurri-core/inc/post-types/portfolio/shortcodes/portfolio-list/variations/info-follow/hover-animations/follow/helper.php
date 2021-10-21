<?php

if ( ! function_exists( 'emaurri_core_filter_portfolio_list_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_filter_portfolio_list_info_follow( $variations ) {
		$variations['follow'] = esc_html__( 'Follow', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_portfolio_list_info_follow_animation_options', 'emaurri_core_filter_portfolio_list_info_follow' );
}
