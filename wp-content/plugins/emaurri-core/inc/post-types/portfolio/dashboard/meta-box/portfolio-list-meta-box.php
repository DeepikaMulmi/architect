<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_item_list_meta_boxes' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function emaurri_core_add_portfolio_item_list_meta_boxes( $page ) {

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'List Settings', 'emaurri-core' ),
					'description' => esc_html__( 'Portfolio list settings', 'emaurri-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_portfolio_list_image',
					'title'       => esc_html__( 'Portfolio List Image', 'emaurri-core' ),
					'description' => esc_html__( 'Upload image to be displayed on portfolio list instead of featured image', 'emaurri-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_portfolio_second_list_image',
					'title'       => esc_html__( 'Portfolio Scrollable Second List Image', 'emaurri-core' ),
					'description' => esc_html__( 'Upload image to be displayed on scrollable portfolio list instead of featured image', 'emaurri-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_portfolio_third_list_image',
					'title'       => esc_html__( 'Portfolio Scrollable Third List Image', 'emaurri-core' ),
					'description' => esc_html__( 'Upload image to be displayed on scrollable portfolio list instead of featured image', 'emaurri-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_portfolio_item',
					'title'       => esc_html__( 'Image Dimension', 'emaurri-core' ),
					'description' => esc_html__( 'Choose an image layout for "masonry behavior" portfolio list. If you are using fixed image proportions on the list, choose an option other than default', 'emaurri-core' ),
					'options'     => emaurri_core_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_item_padding',
					'title'       => esc_html__( 'Portfolio Item Custom Padding', 'emaurri-core' ),
					'description' => esc_html__( 'Choose item padding when it appears in portfolio list (ex. 5% 5% 5% 5%)', 'emaurri-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_item_bg_text',
					'title'       => esc_html__( 'Portfolio Item Background Text', 'emaurri-core' ),
					'description' => esc_html__( 'Text to display behind title in Portfolio Exhibition Shortcode', 'emaurri-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'emaurri_core_action_after_portfolio_list_meta_box_map', $list_tab );
		}
	}

	add_action( 'emaurri_core_action_after_portfolio_meta_box_map', 'emaurri_core_add_portfolio_item_list_meta_boxes' );
}
