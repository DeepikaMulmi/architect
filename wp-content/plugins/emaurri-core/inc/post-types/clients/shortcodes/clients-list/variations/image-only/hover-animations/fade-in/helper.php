<?php

if ( ! function_exists( 'emaurri_core_filter_clients_list_image_only_fade_in' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_filter_clients_list_image_only_fade_in( $variations ) {
		$variations['fade-in'] = esc_html__( 'Fade In', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_clients_list_image_only_animation_options', 'emaurri_core_filter_clients_list_image_only_fade_in' );
}
