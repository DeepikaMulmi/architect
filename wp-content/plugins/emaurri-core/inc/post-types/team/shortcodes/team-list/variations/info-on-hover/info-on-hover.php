<?php

if ( ! function_exists( 'emaurri_core_add_team_list_variation_info_on_hover' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_team_list_variation_info_on_hover( $variations ) {
		$variations['info-on-hover'] = esc_html__( 'Info on Hover', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_team_list_layouts', 'emaurri_core_add_team_list_variation_info_on_hover' );
}
