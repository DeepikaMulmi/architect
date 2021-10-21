<?php

if ( ! function_exists( 'emaurri_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function emaurri_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'emaurri-core' );

		return $options;
	}

	add_filter( 'emaurri_core_filter_header_scroll_appearance_option', 'emaurri_core_add_fixed_header_option' );
}
