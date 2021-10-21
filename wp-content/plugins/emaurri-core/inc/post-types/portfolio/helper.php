<?php

if ( ! function_exists( 'emaurri_core_include_portfolio_media_fields' ) ) {
	/**
	 * Function that include module custom media options
	 */
	function emaurri_core_include_portfolio_media_fields() {
		foreach ( glob( EMAURRI_CORE_CPT_PATH . '/portfolio/dashboard/media/*.php' ) as $media ) {
			include_once $media;
		}
	}

	add_action( 'qode_framework_action_custom_media_fields', 'emaurri_core_include_portfolio_media_fields' );
}

if ( ! function_exists( 'emaurri_core_generate_portfolio_single_layout' ) ) {
	/**
	 * Function that return default layout for custom post type single page
	 *
	 * @return string
	 */
	function emaurri_core_generate_portfolio_single_layout() {
		$portfolio_template = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' );
		$portfolio_template = ! empty( $portfolio_template ) ? $portfolio_template : '';

		return $portfolio_template;
	}

	add_filter( 'emaurri_core_filter_portfolio_single_layout', 'emaurri_core_generate_portfolio_single_layout' );
}

if ( ! function_exists( 'emaurri_core_get_portfolio_holder_classes' ) ) {
	/**
	 * Function that return classes for the main portfolio holder
	 *
	 * @return string
	 */
	function emaurri_core_get_portfolio_holder_classes() {
		$classes = array( 'qodef-portfolio-single' );

		$item_layout = emaurri_core_generate_portfolio_single_layout();
		if ( ! empty( $item_layout ) ) {
			$classes[] = 'qodef-layout--' . $item_layout;
		}

		return implode( ' ', $classes );
	}
}

if ( ! function_exists( 'emaurri_core_set_portfolio_single_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function emaurri_core_set_portfolio_single_body_classes( $classes ) {
		$item_layout = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' );

		if ( is_singular( 'portfolio-item' ) && ! empty( $item_layout ) ) {
			$classes[] = 'qodef-layout--' . $item_layout;
		}

		return $classes;
	}

	add_filter( 'body_class', 'emaurri_core_set_portfolio_single_body_classes' );
}

if ( ! function_exists( 'emaurri_core_generate_portfolio_archive_with_shortcode' ) ) {
	/**
	 * Function that executes portfolio list shortcode with params on archive pages
	 *
	 * @param string $tax - type of taxonomy
	 * @param string $tax_slug - slug of taxonomy
	 *
	 */
	function emaurri_core_generate_portfolio_archive_with_shortcode( $tax, $tax_slug ) {
		$params = array();

		$params['additional_params']         = 'tax';
		$params['tax']                       = $tax;
		$params['tax_slug']                  = $tax_slug;
		$params['layout']                    = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_item_layout' );
		$params['behavior']                  = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_behavior' );
		$params['masonry_images_proportion'] = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_masonry_images_proportion' );
		$params['columns']                   = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns' );
		$params['space']                     = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_space' );
		$params['columns_responsive']        = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_responsive' );
		$params['columns_1440']              = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_1440' );
		$params['columns_1366']              = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_1366' );
		$params['columns_1024']              = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_1024' );
		$params['columns_768']               = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_768' );
		$params['columns_680']               = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_680' );
		$params['columns_480']               = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_columns_480' );
		$params['slider_loop']               = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_slider_loop' );
		$params['slider_autoplay']           = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_slider_autoplay' );
		$params['slider_speed']              = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_slider_speed' );
		$params['slider_navigation']         = emaurri_core_get_post_value_through_levels( 'navigation' );
		$params['slider_pagination']         = emaurri_core_get_post_value_through_levels( 'pagination' );
		$params['pagination_type']           = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_pagination_type' );

		echo EmaurriCore_Portfolio_List_Shortcode::call_shortcode( $params );
	}
}

if ( ! function_exists( 'emaurri_core_is_portfolio_title_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @param bool $is_enabled
	 *
	 * @return bool
	 */
	function emaurri_core_is_portfolio_title_enabled( $is_enabled ) {

		if ( is_singular( 'portfolio-item' ) ) {
			$portfolio_title = emaurri_core_get_post_value_through_levels( 'qodef_enable_portfolio_title' );
			$is_enabled      = '' === $portfolio_title ? $is_enabled : ( 'no' === $portfolio_title ? false : true );
		}

		return $is_enabled;
	}

	add_filter( 'emaurri_core_filter_is_page_title_enabled', 'emaurri_core_is_portfolio_title_enabled' );
}

if ( ! function_exists( 'emaurri_core_portfolio_title_grid' ) ) {
	/**
	 * Function that check is option enabled
	 *
	 * @param bool $enable_title_grid
	 *
	 * @return bool
	 */
	function emaurri_core_portfolio_title_grid( $enable_title_grid ) {
		if ( is_singular( 'portfolio-item' ) ) {
			$portfolio_title_grid = emaurri_core_get_post_value_through_levels( 'qodef_set_portfolio_title_area_in_grid' );
			$enable_title_grid    = '' === $portfolio_title_grid ? $enable_title_grid : ( 'no' === $portfolio_title_grid ? false : true );
		}

		return $enable_title_grid;
	}

	add_filter( 'emaurri_core_filter_page_title_in_grid', 'emaurri_core_portfolio_title_grid' );
}

if ( ! function_exists( 'emaurri_core_portfolio_breadcrumbs_title' ) ) {
	/**
	 * Improve main breadcrumbs template with additional cases
	 *
	 * @param string|html $wrap_child
	 * @param array $settings
	 *
	 * @return string|html
	 */
	function emaurri_core_portfolio_breadcrumbs_title( $wrap_child, $settings ) {
		if ( is_tax( 'portfolio-category' ) ) {
			$wrap_child  = '';
			$term_object = get_term( get_queried_object_id(), 'portfolio-category' );

			if ( isset( $term_object->parent ) && 0 !== $term_object->parent ) {
				$parent      = get_term( $term_object->parent );
				$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name ) . $settings['separator'];
			}

			$wrap_child .= sprintf( $settings['current_item'], single_cat_title( '', false ) );
		} elseif ( is_singular( 'portfolio-item' ) ) {
			$wrap_child = '';
			$post_terms = wp_get_post_terms( get_the_ID(), 'portfolio-category' );

			if ( ! empty( $post_terms ) ) {
				$post_term = $post_terms[0];
				if ( isset( $post_term->parent ) && 0 !== $post_term->parent ) {
					$parent      = get_term( $post_term->parent );
					$wrap_child .= sprintf( $settings['link'], get_term_link( $parent->term_id ), $parent->name ) . $settings['separator'];
				}
				$wrap_child .= sprintf( $settings['link'], get_term_link( $post_term ), $post_term->name ) . $settings['separator'];
			}

			$wrap_child .= sprintf( $settings['current_item'], get_the_title() );
		}

		return $wrap_child;
	}

	add_filter( 'emaurri_core_filter_breadcrumbs_content', 'emaurri_core_portfolio_breadcrumbs_title', 10, 2 );
}

if ( ! function_exists( 'emaurri_core_set_portfolio_custom_sidebar_name' ) ) {
	/**
	 * Function that return sidebar name
	 *
	 * @param string $sidebar_name
	 *
	 * @return string
	 */
	function emaurri_core_set_portfolio_custom_sidebar_name( $sidebar_name ) {

		if ( is_singular( 'portfolio-item' ) ) {
			$option = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_single_custom_sidebar' );
		} elseif ( is_tax() ) {
			$taxonomies = get_object_taxonomies( 'portfolio-item' );

			foreach ( $taxonomies as $tax ) {
				if ( is_tax( $tax ) ) {
					$option = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_custom_sidebar' );
				}
			}
		}

		if ( isset( $option ) && ! empty( $option ) ) {
			$sidebar_name = $option;
		}

		return $sidebar_name;
	}

	add_filter( 'emaurri_filter_sidebar_name', 'emaurri_core_set_portfolio_custom_sidebar_name' );
}

if ( ! function_exists( 'emaurri_core_set_portfolio_sidebar_layout' ) ) {
	/**
	 * Function that return sidebar layout
	 *
	 * @param string $layout
	 *
	 * @return string
	 */
	function emaurri_core_set_portfolio_sidebar_layout( $layout ) {

		if ( is_singular( 'portfolio-item' ) ) {
			$option = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_single_sidebar_layout' );
		} elseif ( is_tax() ) {
			$taxonomies = get_object_taxonomies( 'portfolio-item' );
			foreach ( $taxonomies as $tax ) {
				if ( is_tax( $tax ) ) {
					$option = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_sidebar_layout' );
				}
			}
		}

		if ( isset( $option ) && ! empty( $option ) ) {
			$layout = $option;
		}

		return $layout;
	}

	add_filter( 'emaurri_filter_sidebar_layout', 'emaurri_core_set_portfolio_sidebar_layout' );
}

if ( ! function_exists( 'emaurri_core_set_portfolio_sidebar_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function emaurri_core_set_portfolio_sidebar_grid_gutter_classes( $classes ) {

		if ( is_singular( 'portfolio-item' ) ) {
			$option = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_single_sidebar_grid_gutter' );
		} elseif ( is_tax() ) {
			$taxonomies = get_object_taxonomies( 'portfolio-item' );
			foreach ( $taxonomies as $tax ) {
				if ( is_tax( $tax ) ) {
					$option = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_archive_sidebar_grid_gutter' );
				}
			}
		}
		if ( isset( $option ) && ! empty( $option ) ) {
			$classes = 'qodef-gutter--' . esc_attr( $option );
		}

		return $classes;
	}

	add_filter( 'emaurri_filter_grid_gutter_classes', 'emaurri_core_set_portfolio_sidebar_grid_gutter_classes' );
}

if ( ! function_exists( 'emaurri_core_portfolio_set_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position for this module
	 *
	 * @param int $position
	 * @param string $map
	 *
	 * @return int
	 */
	function emaurri_core_portfolio_set_admin_options_map_position( $position, $map ) {

		if ( 'portfolio' === $map ) {
			$position = 50;
		}

		return $position;
	}

	add_filter( 'emaurri_core_filter_admin_options_map_position', 'emaurri_core_portfolio_set_admin_options_map_position', 10, 2 );
}

if ( ! function_exists( 'emaurri_core_get_portfolio_single_post_taxonomies' ) ) {
	/**
	 * Function that return single post taxonomies list
	 *
	 * @param int $post_id
	 *
	 * @return array
	 */
	function emaurri_core_get_portfolio_single_post_taxonomies( $post_id ) {
		$options = array();

		if ( ! empty( $post_id ) ) {
			$options['portfolio-tag']      = wp_get_post_terms( $post_id, 'portfolio-tag' );
			$options['portfolio-category'] = wp_get_post_terms( $post_id, 'portfolio-category' );
		}

		return $options;
	}
}

if ( ! function_exists( 'emaurri_core_set_portfolio_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function emaurri_core_set_portfolio_styles( $style ) {
		$scope = EMAURRI_CORE_OPTIONS_NAME;

		$label_styles      = emaurri_core_get_typography_styles( $scope, 'qodef_portfolio_label' );
		$info_styles       = emaurri_core_get_typography_styles( $scope, 'qodef_portfolio_info' );
		$info_hover_styles = emaurri_core_get_typography_hover_styles( $scope, 'qodef_portfolio_info' );

		if ( ! empty( $label_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-portfolio-single .qodef-portfolio-info .qodef-e-title',
				),
				$label_styles
			);
		}

		if ( ! empty( $info_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-portfolio-single .qodef-portfolio-info p',
					'.qodef-portfolio-single .qodef-portfolio-info a',
				),
				$info_styles
			);
		}

		if ( ! empty( $info_hover_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-portfolio-single .qodef-portfolio-info a:hover',
				),
				$info_hover_styles
			);
		}

		return $style;
	}

	add_filter( 'emaurri_filter_add_inline_style', 'emaurri_core_set_portfolio_styles' );
}
