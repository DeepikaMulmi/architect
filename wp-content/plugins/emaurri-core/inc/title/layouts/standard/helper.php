<?php

if ( ! function_exists( 'emaurri_core_register_standard_title_layout' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $layouts
	 *
	 * @return array
	 */
	function emaurri_core_register_standard_title_layout( $layouts ) {
		$layouts['standard'] = 'EmaurriCore_Standard_Title';

		return $layouts;
	}

	add_filter( 'emaurri_core_filter_register_title_layouts', 'emaurri_core_register_standard_title_layout' );
}

if ( ! function_exists( 'emaurri_core_add_standard_title_layout_option' ) ) {
	/**
	 * Function that set new value into title layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function emaurri_core_add_standard_title_layout_option( $layouts ) {
		$layouts['standard'] = esc_html__( 'Standard', 'emaurri-core' );

		return $layouts;
	}

	add_filter( 'emaurri_core_filter_title_layout_options', 'emaurri_core_add_standard_title_layout_option' );
}

if ( ! function_exists( 'emaurri_core_get_standard_title_layout_subtitle_text' ) ) {
	/**
	 * Function that render current page subtitle text
	 */
	function emaurri_core_get_standard_title_layout_subtitle_text() {
		$subtitle_meta = emaurri_core_get_post_value_through_levels( 'qodef_page_title_subtitle' );
		$subtitle      = array( 'subtitle' => ! empty( $subtitle_meta ) ? $subtitle_meta : '' );

		return apply_filters( 'emaurri_core_filter_standard_title_layout_subtitle_text', $subtitle );
	}
}
