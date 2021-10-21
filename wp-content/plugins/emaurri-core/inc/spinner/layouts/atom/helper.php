<?php

if ( ! function_exists( 'emaurri_core_add_atom_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function emaurri_core_add_atom_spinner_layout_option( $layouts ) {
		$layouts['atom'] = esc_html__( 'Atom', 'emaurri-core' );

		return $layouts;
	}

	add_filter( 'emaurri_core_filter_page_spinner_layout_options', 'emaurri_core_add_atom_spinner_layout_option' );
}
