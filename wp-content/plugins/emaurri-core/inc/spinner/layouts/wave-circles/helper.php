<?php

if ( ! function_exists( 'emaurri_core_add_wave_circles_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function emaurri_core_add_wave_circles_spinner_layout_option( $layouts ) {
		$layouts['wave-circles'] = esc_html__( 'Wave Circles', 'emaurri-core' );

		return $layouts;
	}

	add_filter( 'emaurri_core_filter_page_spinner_layout_options', 'emaurri_core_add_wave_circles_spinner_layout_option' );
}
