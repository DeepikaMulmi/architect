<?php

if ( ! function_exists( 'emaurri_core_is_page_content_side_enabled' ) ) {
	/**
	 * function that check is module enabled
	 *
	 * @param $is_enabled bool
	 *
	 * @return bool
	 */
	function emaurri_core_is_page_content_side_enabled( $is_enabled ) {
		$option = emaurri_core_get_post_value_through_levels( 'qodef_enable_page_content_side' ) !== 'no';

		if ( ! $option ) {
			$is_enabled = false;
		}

		return $is_enabled;
	}

	add_filter( 'emaurri_core_filter_enable_page_content_side', 'emaurri_core_is_page_content_side_enabled' );
}

if ( ! function_exists( 'emaurri_core_filter_enable_page_content_side' ) ) {
	/**
	 * function that check is module enabled
	 */
	function emaurri_core_filter_enable_page_content_side() {
		$is_enabled = true;

		return apply_filters( 'emaurri_core_filter_enable_page_content_side', $is_enabled );
	}
}

if ( ! function_exists( 'emaurri_core_load_page_content_side' ) ) {
	/**
	 * function which loads page template module
	 */
	function emaurri_core_load_page_content_side() {

		if ( emaurri_core_filter_enable_page_content_side() ) {
			echo apply_filters( 'emaurri_core_filter_content_side_template', emaurri_core_get_template_part( 'content-side', 'templates/content-side' ) );
		}
	}

	add_action( 'emaurri_action_before_page_footer_template', 'emaurri_core_load_page_content_side' );
}

if ( ! function_exists( 'emaurri_core_add_content_side_to_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function emaurri_core_add_content_side_to_body_classes( $classes ) {
		$classes[] = emaurri_core_filter_enable_page_content_side() ? 'qodef-content-side--enabled' : '';

		return $classes;
	}

	add_filter( 'body_class', 'emaurri_core_add_content_side_to_body_classes' );
}
