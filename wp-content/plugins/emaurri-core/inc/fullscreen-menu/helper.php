<?php

if ( ! function_exists( 'emaurri_core_register_fullscreen_menu' ) ) {
	/**
	 * Function which add additional main menu navigation into global list
	 *
	 * @param array $menus
	 *
	 * @return array
	 */
	function emaurri_core_register_fullscreen_menu( $menus ) {
		$menus['fullscreen-menu-navigation'] = esc_html__( 'Fullscreen Navigation', 'emaurri-core' );

		return $menus;
	}

	add_filter( 'emaurri_filter_register_navigation_menus', 'emaurri_core_register_fullscreen_menu' );
}

if ( ! function_exists( 'emaurri_core_set_fullscreen_menu_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function emaurri_core_set_fullscreen_menu_styles( $style ) {
		$styles = array();

		$background_color = emaurri_core_get_post_value_through_levels( 'qodef_fullscreen_menu_background_color' );
		$background_image = emaurri_core_get_post_value_through_levels( 'qodef_fullscreen_menu_background_image' );

		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}

		if ( ! empty( $background_image ) ) {
			$styles['background-image'] = 'url(' . esc_url( wp_get_attachment_image_url( $background_image, 'full' ) ) . ')';
		}

		if ( ! empty( $styles ) ) {
			$selector = '#qodef-fullscreen-area';

			$style .= qode_framework_dynamic_style( $selector, $styles );
		}

		return $style;
	}

	add_filter( 'emaurri_filter_add_inline_style', 'emaurri_core_set_fullscreen_menu_styles' );
}

if ( ! function_exists( 'emaurri_core_set_fullscreen_menu_typography_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function emaurri_core_set_fullscreen_menu_typography_styles( $style ) {
		$scope = EMAURRI_CORE_OPTIONS_NAME;

		$first_lvl_styles        = emaurri_core_get_typography_styles( $scope, 'qodef_fullscreen_1st_lvl' );
		$first_lvl_hover_styles  = emaurri_core_get_typography_hover_styles( $scope, 'qodef_fullscreen_1st_lvl' );
		$second_lvl_styles       = emaurri_core_get_typography_styles( $scope, 'qodef_fullscreen_2nd_lvl' );
		$second_lvl_hover_styles = emaurri_core_get_typography_hover_styles( $scope, 'qodef_fullscreen_2nd_lvl' );

		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu > ul > li > a', $first_lvl_styles );
		}

		if ( ! empty( $first_lvl_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu > ul > li > a:hover', $first_lvl_hover_styles );
		}

		$first_lvl_active_color = emaurri_core_get_option_value( 'admin', 'qodef_fullscreen_1st_lvl_active_color' );

		if ( ! empty( $first_lvl_active_color ) ) {
			$first_lvl_active_styles = array(
				'color' => $first_lvl_active_color,
			);

			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-fullscreen-menu > ul >li.current-menu-ancestor > a',
					'.qodef-fullscreen-menu > ul >li.current-menu-item > a',
				),
				$first_lvl_active_styles
			);
		}

		if ( ! empty( $second_lvl_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu .qodef-drop-down-second-inner ul li > a', $second_lvl_styles );
		}

		if ( ! empty( $second_lvl_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu .qodef-drop-down-second-inner ul li > a:hover', $second_lvl_hover_styles );
		}

		$second_lvl_active_color = emaurri_core_get_option_value( 'admin', 'qodef_fullscreen_2nd_lvl_active_color' );

		if ( ! empty( $second_lvl_active_color ) ) {
			$second_lvl_active_styles = array(
				'color' => $second_lvl_active_color,
			);

			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-fullscreen-menu .qodef-drop-down-second ul li.current-menu-ancestor > a',
					'.qodef-fullscreen-menu .qodef-drop-down-second ul li.current-menu-item > a',
				),
				$second_lvl_active_styles
			);
		}

		return $style;
	}

	add_filter( 'emaurri_filter_add_inline_style', 'emaurri_core_set_fullscreen_menu_typography_styles' );
}
