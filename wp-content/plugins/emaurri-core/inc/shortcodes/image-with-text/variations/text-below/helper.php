<?php

if ( ! function_exists( 'emaurri_core_add_image_with_text_variation_text_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_image_with_text_variation_text_below( $variations ) {
		$variations['text-below'] = esc_html__( 'Text Below', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_image_with_text_layouts', 'emaurri_core_add_image_with_text_variation_text_below' );
}
