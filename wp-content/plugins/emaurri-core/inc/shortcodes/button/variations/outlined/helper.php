<?php

if ( ! function_exists( 'emaurri_core_add_button_variation_outlined' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_button_variation_outlined( $variations ) {
		$variations['outlined'] = esc_html__( 'Outlined', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_button_layouts', 'emaurri_core_add_button_variation_outlined' );
}
