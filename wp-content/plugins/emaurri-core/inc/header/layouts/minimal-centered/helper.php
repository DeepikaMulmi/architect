<?php
if ( ! function_exists( 'emaurri_core_add_minimal_centered_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */

	function emaurri_core_add_minimal_centered_header_global_option( $header_layout_options ) {
		$header_layout_options['minimal-centered'] = array(
			'image' => EMAURRI_CORE_HEADER_LAYOUTS_URL_PATH . '/minimal-centered/assets/img/minimal-centered-header.png',
			'label' => esc_html__( 'Minimal Centered', 'emaurri-core' ),
		);

		return $header_layout_options;
	}

	add_filter( 'emaurri_core_filter_header_layout_option', 'emaurri_core_add_minimal_centered_header_global_option' );
}


if ( ! function_exists( 'emaurri_core_register_minimal_centered_header_layout' ) ) {
	/**
	 * Function which add header layout into global list
	 *
	 * @param array $header_layouts
	 *
	 * @return array
	 */
	function emaurri_core_register_minimal_centered_header_layout( $header_layouts ) {
		$header_layout = array(
			'minimal-centered' => 'EmaurriCore_Minimal_Centered_Header',
		);

		$header_layouts = array_merge( $header_layouts, $header_layout );

		return $header_layouts;
	}

	add_filter( 'emaurri_core_filter_register_header_layouts', 'emaurri_core_register_minimal_centered_header_layout' );
}
