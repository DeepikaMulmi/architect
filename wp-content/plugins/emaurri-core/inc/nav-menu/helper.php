<?php

if ( ! function_exists( 'emaurri_core_dropdown_item_classes' ) ) {
	/**
	 * Function that override main navigation dropdown item classes
	 *
	 * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
	 * @param WP_Post $item The current menu item.
	 * @param stdClass $args An object of wp_nav_menu() arguments.
	 * @param int $depth Depth of menu item. Used for padding.
	 *
	 * @return array
	 */
	function emaurri_core_dropdown_item_classes( $classes, $item, $args, $depth ) {

		if ( 0 === $depth && in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$mega_menu   = emaurri_core_get_option_value( 'nav-menu', 'qodef-enable-mega-menu', '', $item->ID );
			$mega_menu_e = is_array( $mega_menu ) && in_array( 'enable', $mega_menu, true );

			if ( $mega_menu_e ) {
				$classes   = array_diff( $classes, array( 'qodef-menu-item--narrow' ) );
				$classes[] = 'qodef-menu-item--wide';

				add_filter(
					'emaurri_core_filter_drop_down_second_inner_classes',
					function ( $inner_classes ) {
						$grid_class = false;
						$full_width = emaurri_core_get_post_value_through_levels( 'qodef_wide_dropdown_full_width' );
						$grid       = emaurri_core_get_post_value_through_levels( 'qodef_wide_dropdown_content_grid' );

						if ( 'yes' === $grid || 'no' === $full_width ) {
							$grid_class = true;
						}

						$grid_class = apply_filters( 'emaurri_core_filter_drop_down_grid', $grid_class );

						if ( $grid_class ) {
							$inner_classes[] = 'qodef-content-grid';
						}

						return $inner_classes;
					}
				);
			} else {

				add_filter(
					'emaurri_core_filter_drop_down_second_inner_classes',
					function ( $inner_classes ) {
						$inner_classes = array_diff( $inner_classes, array( 'qodef-content-grid' ) );

						return $inner_classes;
					}
				);
			}
		}

		return $classes;
	}

	add_filter( 'nav_menu_css_class', 'emaurri_core_dropdown_item_classes', 11, 4 );
}

if ( ! function_exists( 'emaurri_core_add_nav_menu_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function emaurri_core_add_nav_menu_body_classes( $classes ) {
		$full_width = emaurri_core_get_post_value_through_levels( 'qodef_wide_dropdown_full_width' );
		$appearance = emaurri_core_get_post_value_through_levels( 'qodef_dropdown_appearance' );

		if ( 'yes' === $full_width ) {
			$classes[] = 'qodef-drop-down-second--full-width';
		}

		if ( ! empty( $appearance ) ) {
			$classes[] = 'qodef-drop-down-second--' . esc_attr( $appearance );
		}

		return $classes;
	}

	add_filter( 'body_class', 'emaurri_core_add_nav_menu_body_classes' );
}

if ( ! function_exists( 'emaurri_core_set_nav_menu_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function emaurri_core_set_nav_menu_styles( $style ) {
		$styles = array();

		$dropdown_top_position = emaurri_core_get_post_value_through_levels( 'qodef_dropdown_top_position' );

		if ( '' !== $dropdown_top_position ) {
			if ( qode_framework_string_ends_with_space_units( $dropdown_top_position, true ) ) {
				$styles['top'] = $dropdown_top_position;
			} else {
				$styles['top'] = intval( $dropdown_top_position ) . '%';
			}
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header-navigation ul li .qodef-drop-down-second', $styles );
		}

		$dropdown_bg_color = emaurri_core_get_post_value_through_levels( 'qodef_dropdown_background_color' );

		if ( ! empty( $dropdown_bg_color ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header-navigation ul li.qodef-menu-item--narrow ul', array( 'background-color' => $dropdown_bg_color ) );
		}

		$wide_dropdown_bg_color = emaurri_core_get_post_value_through_levels( 'qodef_wide_dropdown_background_color' );

		if ( ! empty( $wide_dropdown_bg_color ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header-navigation ul li.qodef-menu-item--wide .qodef-drop-down-second', array( 'background-color' => $wide_dropdown_bg_color ) );
		}

		return $style;
	}

	add_filter( 'emaurri_filter_add_inline_style', 'emaurri_core_set_nav_menu_styles' );
}

if ( ! function_exists( 'emaurri_core_set_nav_menu_typography_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function emaurri_core_set_nav_menu_typography_styles( $style ) {
		$scope = EMAURRI_CORE_OPTIONS_NAME;

		$first_lvl_styles             = emaurri_core_get_typography_styles( $scope, 'qodef_nav_1st_lvl' );
		$first_lvl_hover_styles       = emaurri_core_get_typography_hover_styles( $scope, 'qodef_nav_1st_lvl' );
		$second_lvl_styles            = emaurri_core_get_typography_styles( $scope, 'qodef_nav_2nd_lvl' );
		$second_lvl_hover_styles      = emaurri_core_get_typography_hover_styles( $scope, 'qodef_nav_2nd_lvl' );
		$second_lvl_wide_styles       = emaurri_core_get_typography_styles( $scope, 'qodef_nav_2nd_lvl_wide' );
		$second_lvl_wide_hover_styles = emaurri_core_get_typography_hover_styles( $scope, 'qodef_nav_2nd_lvl_wide' );
		$third_lvl_wide_styles        = emaurri_core_get_typography_styles( $scope, 'qodef_nav_3rd_lvl_wide' );
		$third_lvl_wide_hover_styles  = emaurri_core_get_typography_hover_styles( $scope, 'qodef_nav_3rd_lvl_wide' );

		$header_selector      = apply_filters( 'emaurri_core_filter_nav_menu_header_selector', '.qodef-header-navigation' );
		$narrow_menu_selector = apply_filters( 'emaurri_core_filter_nav_menu_narrow_header_selector', '.qodef-menu-item--narrow' );
		$wide_menu_selector   = '.qodef-menu-item--wide';

		$first_lvl_side_padding = emaurri_core_get_option_value( 'admin', 'qodef_nav_1st_lvl_padding' );
		if ( '' !== $first_lvl_side_padding ) {
			if ( qode_framework_string_ends_with_space_units( $first_lvl_side_padding, true ) ) {
				$first_lvl_styles['padding-left']  = $first_lvl_side_padding;
				$first_lvl_styles['padding-right'] = $first_lvl_side_padding;
			} else {
				$first_lvl_styles['padding-left']  = intval( $first_lvl_side_padding ) . 'px';
				$first_lvl_styles['padding-right'] = intval( $first_lvl_side_padding ) . 'px';
			}
		}

		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_framework_dynamic_style( $header_selector . '> ul > li > a', $first_lvl_styles );
		}

		if ( ! empty( $first_lvl_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( $header_selector . '> ul > li > a:hover', $first_lvl_hover_styles );
		}

		$first_lvl_active_color = emaurri_core_get_option_value( 'admin', 'qodef_nav_1st_lvl_active_color' );

		if ( ! empty( $first_lvl_active_color ) ) {
			$first_lvl_active_styles = array(
				'color' => $first_lvl_active_color,
			);

			$style .= qode_framework_dynamic_style(
				array(
					$header_selector . '> ul > li.current-menu-ancestor > a',
					$header_selector . '> ul > li.current-menu-item > a',
				),
				$first_lvl_active_styles
			);
		}

		$first_lvl_side_margin = emaurri_core_get_option_value( 'admin', 'qodef_nav_1st_lvl_margin' );
		if ( '' !== $first_lvl_side_margin ) {
			$first_lvl_li_styles = array();

			if ( qode_framework_string_ends_with_space_units( $first_lvl_side_margin, true ) ) {
				$first_lvl_li_styles['margin-left']  = $first_lvl_side_margin;
				$first_lvl_li_styles['margin-right'] = $first_lvl_side_margin;
			} else {
				$first_lvl_li_styles['margin-left']  = intval( $first_lvl_side_margin ) . 'px';
				$first_lvl_li_styles['margin-right'] = intval( $first_lvl_side_margin ) . 'px';
			}

			$style .= qode_framework_dynamic_style( array( $header_selector . '> ul > li' ), $first_lvl_li_styles );
		}

		if ( ! empty( $second_lvl_styles ) ) {
			$style .= qode_framework_dynamic_style( $header_selector . ' > ul > li' . $narrow_menu_selector . ' .qodef-drop-down-second ul li a', $second_lvl_styles );
		}

		if ( ! empty( $second_lvl_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( $header_selector . ' > ul > li' . $narrow_menu_selector . ' .qodef-drop-down-second ul li:hover > a', $second_lvl_hover_styles );
		}

		$second_lvl_active_color = emaurri_core_get_option_value( 'admin', 'qodef_nav_2nd_lvl_active_color' );

		if ( ! empty( $second_lvl_active_color ) ) {
			$second_lvl_active_styles = array(
				'color' => $second_lvl_active_color,
			);

			$style .= qode_framework_dynamic_style(
				array(
					$header_selector . ' > ul > li' . $narrow_menu_selector . ' .qodef-drop-down-second ul li.current-menu-ancestor > a',
					$header_selector . ' > ul > li' . $narrow_menu_selector . ' .qodef-drop-down-second ul li.current-menu-item > a',
				),
				$second_lvl_active_styles
			);
		}

		if ( ! empty( $second_lvl_wide_styles ) ) {
			$style .= qode_framework_dynamic_style( $header_selector . ' > ul > li' . $wide_menu_selector . ' .qodef-drop-down-second-inner > ul > li > a', $second_lvl_wide_styles );
		}

		if ( ! empty( $second_lvl_wide_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( $header_selector . ' > ul > li' . $wide_menu_selector . ' .qodef-drop-down-second-inner > ul > li > a:hover', $second_lvl_wide_hover_styles );
		}

		$second_lvl_wide_active_color = emaurri_core_get_option_value( 'admin', 'qodef_nav_2nd_lvl_wide_active_color' );

		if ( ! empty( $second_lvl_wide_active_color ) ) {
			$second_lvl_wide_active_styles = array(
				'color' => $second_lvl_wide_active_color,
			);

			$style .= qode_framework_dynamic_style(
				array(
					$header_selector . ' > ul > li' . $wide_menu_selector . ' .qodef-drop-down-second-inner > ul > li.current-menu-ancestor > a',
					$header_selector . ' > ul > li' . $wide_menu_selector . ' .qodef-drop-down-second-inner > ul > li.current-menu-item > a',
				),
				$second_lvl_wide_active_styles
			);
		}

		if ( ! empty( $third_lvl_wide_styles ) ) {
			$style .= qode_framework_dynamic_style( $header_selector . ' > ul > li' . $wide_menu_selector . ' .qodef-drop-down-second ul li ul li a', $third_lvl_wide_styles );
		}

		if ( ! empty( $third_lvl_wide_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( $header_selector . ' > ul > li' . $wide_menu_selector . ' .qodef-drop-down-second ul li ul li:hover > a', $third_lvl_wide_hover_styles );
		}

		$third_lvl_wide_active_color = emaurri_core_get_option_value( 'admin', 'qodef_nav_3rd_lvl_wide_active_color' );

		if ( ! empty( $third_lvl_wide_active_color ) ) {
			$third_lvl_wide_active_styles = array(
				'color' => $third_lvl_wide_active_color,
			);

			$style .= qode_framework_dynamic_style(
				array(
					$header_selector . ' > ul > li' . $wide_menu_selector . ' .qodef-drop-down-second ul li ul li.current-menu-ancestor > a',
					$header_selector . ' > ul > li' . $wide_menu_selector . ' .qodef-drop-down-second ul li ul li.current-menu-item > a',
				),
				$third_lvl_wide_active_styles
			);
		}

		return $style;
	}

	add_filter( 'emaurri_filter_add_inline_style', 'emaurri_core_set_nav_menu_typography_styles' );
}
