<?php

if ( ! function_exists( 'emaurri_core_add_banner_variation_link_button' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_banner_variation_link_button( $variations ) {
		$variations['link-button'] = esc_html__( 'Link Button', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_banner_layouts', 'emaurri_core_add_banner_variation_link_button' );
}
