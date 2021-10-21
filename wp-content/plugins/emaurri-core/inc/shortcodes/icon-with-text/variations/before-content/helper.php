<?php

if ( ! function_exists( 'emaurri_core_add_icon_with_text_variation_before_content' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_icon_with_text_variation_before_content( $variations ) {
		$variations['before-content'] = esc_html__( 'Before Content', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_icon_with_text_layouts', 'emaurri_core_add_icon_with_text_variation_before_content' );
}
