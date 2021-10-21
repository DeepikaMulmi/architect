<?php

if ( ! function_exists( 'emaurri_core_add_blog_list_variation_minimal' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_blog_list_variation_minimal( $variations ) {
		$variations['minimal'] = esc_html__( 'Minimal', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_blog_list_layouts', 'emaurri_core_add_blog_list_variation_minimal' );
}
