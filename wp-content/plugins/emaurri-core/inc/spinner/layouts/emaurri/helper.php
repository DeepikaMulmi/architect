<?php

if ( ! function_exists( 'emaurri_core_add_emaurri_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function emaurri_core_add_emaurri_spinner_layout_option( $layouts ) {
		$layouts['emaurri'] = esc_html__( 'Emaurri', 'emaurri-core' );

		return $layouts;
	}

	add_filter( 'emaurri_core_filter_page_spinner_layout_options', 'emaurri_core_add_emaurri_spinner_layout_option' );
}

if ( ! function_exists( 'emaurri_core_set_emaurri_spinner_layout_as_default_option' ) ) {
	/**
	 * Function that set default value for page spinner layout options map
	 *
	 * @param string $default_value
	 *
	 * @return string
	 */
	function emaurri_core_set_emaurri_spinner_layout_as_default_option( $default_value ) {
		return 'emaurri';
	}

	add_filter( 'emaurri_core_filter_page_spinner_default_layout_option', 'emaurri_core_set_emaurri_spinner_layout_as_default_option' );
}
