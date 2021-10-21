<?php

if ( ! function_exists( 'emaurri_core_add_clients_list_variation_image_only' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_clients_list_variation_image_only( $variations ) {
		$variations['image-only'] = esc_html__( 'Image Only', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_clients_list_layouts', 'emaurri_core_add_clients_list_variation_image_only' );
}
