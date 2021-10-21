<?php

if ( ! function_exists( 'emaurri_core_is_page_spinner_enabled' ) ) {
	/**
	 * Function that check is option enabled
	 *
	 * @return bool
	 */
	function emaurri_core_is_page_spinner_enabled() {
		return 'yes' === emaurri_core_get_post_value_through_levels( 'qodef_enable_page_spinner' );
	}
}

if ( ! function_exists( 'emaurri_core_set_page_spinner_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function emaurri_core_set_page_spinner_body_classes( $classes ) {
		$is_enabled = 'yes' === emaurri_core_get_post_value_through_levels( 'qodef_page_spinner_fade_out_animation' );

		if ( emaurri_core_is_page_spinner_enabled() && $is_enabled ) {
			$classes[] = 'qodef-spinner--fade-out';
		}

		return $classes;
	}

	add_filter( 'body_class', 'emaurri_core_set_page_spinner_body_classes' );
}

if ( ! function_exists( 'emaurri_core_load_page_spinner' ) ) {
	/**
	 * Loads Spinners HTML
	 */
	function emaurri_core_load_page_spinner() {

		if ( emaurri_core_is_page_spinner_enabled() ) {
			$parameters = array();

			emaurri_core_template_part( 'spinner', 'templates/spinner', '', $parameters );
		}
	}

	add_action( 'emaurri_action_after_body_tag_open', 'emaurri_core_load_page_spinner' );
}

if ( ! function_exists( 'emaurri_core_get_spinners_type' ) ) {
	/**
	 * Function that return module layout template content
	 *
	 * @return string that contains html content
	 */
	function emaurri_core_get_spinners_type() {
		$html = '';
		$type = emaurri_core_get_post_value_through_levels( 'qodef_page_spinner_type' );

		if ( ! empty( $type ) ) {
			$html = emaurri_core_get_template_part( 'spinner', 'layouts/' . $type . '/templates/' . $type );
		}

		echo wp_kses_post( $html );
	}
}

if ( ! function_exists( 'emaurri_core_set_page_spinner_classes' ) ) {
	/**
	 * Function that return classes for page spinner area
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function emaurri_core_set_page_spinner_classes( $classes ) {
		$type = emaurri_core_get_post_value_through_levels( 'qodef_page_spinner_type' );

		if ( ! empty( $type ) ) {
			$classes[] = 'qodef-layout--' . esc_attr( $type );
		}

		return $classes;
	}

	add_filter( 'emaurri_core_filter_page_spinner_classes', 'emaurri_core_set_page_spinner_classes' );
}

if ( ! function_exists( 'emaurri_core_set_page_spinner_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function emaurri_core_set_page_spinner_styles( $style ) {
		$spinner_styles = array();

		$spinner_background_color = emaurri_core_get_post_value_through_levels( 'qodef_page_spinner_background_color' );
		$spinner_color            = emaurri_core_get_post_value_through_levels( 'qodef_page_spinner_color' );

		if ( ! empty( $spinner_background_color ) ) {
			$spinner_styles['background-color'] = $spinner_background_color;
		}

		if ( ! empty( $spinner_color ) ) {
			$spinner_styles['color'] = $spinner_color;
		}

		if ( ! empty( $spinner_styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-page-spinner .qodef-m-inner', $spinner_styles );
		}

		return $style;
	}

	add_filter( 'emaurri_filter_add_inline_style', 'emaurri_core_set_page_spinner_styles' );
}
