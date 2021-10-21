<?php

if ( ! function_exists( 'emaurri_core_add_social_share_variation_text' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_social_share_variation_text( $variations ) {
		$variations['text'] = esc_html__( 'Text', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_social_share_layouts', 'emaurri_core_add_social_share_variation_text' );
}
