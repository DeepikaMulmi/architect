<?php

if ( ! function_exists( 'emaurri_core_register_fullscreen_search_layout' ) ) {
	/**
	 * Function that add variation layout into global list
	 *
	 * @param array $search_layouts
	 *
	 * @return array
	 */
	function emaurri_core_register_fullscreen_search_layout( $search_layouts ) {
		$search_layouts['fullscreen'] = 'EmaurriCore_Fullscreen_Search';

		return $search_layouts;
	}

	add_filter( 'emaurri_core_filter_register_search_layouts', 'emaurri_core_register_fullscreen_search_layout' );
}
