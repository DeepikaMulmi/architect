<?php

if ( ! function_exists( 'emaurri_core_add_accordion_variation_simple' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_accordion_variation_simple( $variations ) {
		$variations['simple'] = esc_html__( 'Simple', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_accordion_layouts', 'emaurri_core_add_accordion_variation_simple' );
}
