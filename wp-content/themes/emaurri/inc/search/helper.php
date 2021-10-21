<?php

if ( ! function_exists( 'emaurri_get_search_page_excerpt_length' ) ) {
	/**
	 * Function that return number of characters for excerpt on search page
	 *
	 * @return int
	 */
	function emaurri_get_search_page_excerpt_length() {
		$length = apply_filters( 'emaurri_filter_post_excerpt_length', 180 );

		return intval( $length );
	}
}
