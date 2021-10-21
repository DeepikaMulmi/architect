<?php

if ( ! function_exists( 'emaurri_core_add_single_image_variation_default' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_single_image_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_single_image_layouts', 'emaurri_core_add_single_image_variation_default' );
}
