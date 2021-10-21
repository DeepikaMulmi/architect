<?php

if ( ! function_exists( 'emaurri_core_add_social_share_variation_dropdown' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_social_share_variation_dropdown( $variations ) {
		$variations['dropdown'] = esc_html__( 'Dropdown', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_social_share_layouts', 'emaurri_core_add_social_share_variation_dropdown' );
}
