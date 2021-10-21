<?php

if ( ! function_exists( 'emaurri_core_add_banner_variation_link_overlay' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_banner_variation_link_overlay( $variations ) {
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_banner_layouts', 'emaurri_core_add_banner_variation_link_overlay' );
}
