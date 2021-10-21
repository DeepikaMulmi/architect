<?php

if ( ! function_exists( 'emaurri_core_add_image_marquee_variation_default' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_image_marquee_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_image_marquee_layouts', 'emaurri_core_add_image_marquee_variation_default' );
}
