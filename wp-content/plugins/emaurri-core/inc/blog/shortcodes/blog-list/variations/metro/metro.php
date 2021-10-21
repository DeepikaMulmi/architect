<?php

if ( ! function_exists( 'emaurri_core_add_blog_list_variation_metro' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_blog_list_variation_metro( $variations ) {
		$variations['metro'] = esc_html__( 'Metro', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_blog_list_layouts', 'emaurri_core_add_blog_list_variation_metro' );
}
