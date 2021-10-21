<?php

if ( ! function_exists( 'emaurri_core_add_general_page_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function emaurri_core_add_general_page_meta_box( $page ) {

		$general_tab = $page->add_tab_element(
			array(
				'name'        => 'tab-page',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Page Settings', 'emaurri-core' ),
				'description' => esc_html__( 'General page layout settings', 'emaurri-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_page_background_color',
				'title'       => esc_html__( 'Page Background Color', 'emaurri-core' ),
				'description' => esc_html__( 'Set background color', 'emaurri-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_page_background_image',
				'title'       => esc_html__( 'Page Background Image', 'emaurri-core' ),
				'description' => esc_html__( 'Set background image', 'emaurri-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_repeat',
				'title'       => esc_html__( 'Page Background Image Repeat', 'emaurri-core' ),
				'description' => esc_html__( 'Set background image repeat', 'emaurri-core' ),
				'options'     => array(
					''          => esc_html__( 'Default', 'emaurri-core' ),
					'no-repeat' => esc_html__( 'No Repeat', 'emaurri-core' ),
					'repeat'    => esc_html__( 'Repeat', 'emaurri-core' ),
					'repeat-x'  => esc_html__( 'Repeat-x', 'emaurri-core' ),
					'repeat-y'  => esc_html__( 'Repeat-y', 'emaurri-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_size',
				'title'       => esc_html__( 'Page Background Image Size', 'emaurri-core' ),
				'description' => esc_html__( 'Set background image size', 'emaurri-core' ),
				'options'     => array(
					''        => esc_html__( 'Default', 'emaurri-core' ),
					'contain' => esc_html__( 'Contain', 'emaurri-core' ),
					'cover'   => esc_html__( 'Cover', 'emaurri-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_attachment',
				'title'       => esc_html__( 'Page Background Image Attachment', 'emaurri-core' ),
				'description' => esc_html__( 'Set background image attachment', 'emaurri-core' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'emaurri-core' ),
					'fixed'  => esc_html__( 'Fixed', 'emaurri-core' ),
					'scroll' => esc_html__( 'Scroll', 'emaurri-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding',
				'title'       => esc_html__( 'Page Content Padding', 'emaurri-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'emaurri-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding_mobile',
				'title'       => esc_html__( 'Page Content Padding Mobile', 'emaurri-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'emaurri-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_boxed',
				'title'         => esc_html__( 'Boxed Layout', 'emaurri-core' ),
				'description'   => esc_html__( 'Set boxed layout', 'emaurri-core' ),
				'default_value' => '',
				'options'       => emaurri_core_get_select_type_options_pool( 'yes_no' ),
			)
		);

		$boxed_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_boxed_section',
				'title'      => esc_html__( 'Boxed Layout Section', 'emaurri-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_boxed' => array(
							'values'        => 'no',
							'default_value' => '',
						),
					),
				),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_boxed_background_color',
				'title'       => esc_html__( 'Boxed Background Color', 'emaurri-core' ),
				'description' => esc_html__( 'Set boxed background color', 'emaurri-core' ),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_boxed_background_pattern',
				'title'       => esc_html__( 'Boxed Background Pattern', 'emaurri-core' ),
				'description' => esc_html__( 'Set boxed background pattern', 'emaurri-core' ),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_boxed_background_pattern_behavior',
				'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'emaurri-core' ),
				'description' => esc_html__( 'Set boxed background pattern behavior', 'emaurri-core' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'emaurri-core' ),
					'fixed'  => esc_html__( 'Fixed', 'emaurri-core' ),
					'scroll' => esc_html__( 'Scroll', 'emaurri-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_passepartout',
				'title'         => esc_html__( 'Passepartout', 'emaurri-core' ),
				'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'emaurri-core' ),
				'default_value' => '',
				'options'       => emaurri_core_get_select_type_options_pool( 'yes_no' ),
			)
		);

		$passepartout_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_passepartout_section',
				'dependency' => array(
					'hide' => array(
						'qodef_passepartout' => array(
							'values'        => 'no',
							'default_value' => '',
						),
					),
				),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_passepartout_color',
				'title'       => esc_html__( 'Passepartout Color', 'emaurri-core' ),
				'description' => esc_html__( 'Choose background color for passepartout', 'emaurri-core' ),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_passepartout_image',
				'title'       => esc_html__( 'Passepartout Background Image', 'emaurri-core' ),
				'description' => esc_html__( 'Set background image for passepartout', 'emaurri-core' ),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size',
				'title'       => esc_html__( 'Passepartout Size', 'emaurri-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout', 'emaurri-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'emaurri-core' ),
				),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size_responsive',
				'title'       => esc_html__( 'Passepartout Responsive Size', 'emaurri-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'emaurri-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'emaurri-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_width',
				'title'       => esc_html__( 'Initial Width of Content', 'emaurri-core' ),
				'description' => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'emaurri-core' ),
				'options'     => emaurri_core_get_select_type_options_pool( 'content_width' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_content_behind_header',
				'title'         => esc_html__( 'Always put content behind header', 'emaurri-core' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'emaurri-core' ),
			)
		);

		// Hook to include additional options after module options
		do_action( 'emaurri_core_action_after_general_page_meta_box_map', $general_tab );
	}

	add_action( 'emaurri_core_action_after_general_meta_box_map', 'emaurri_core_add_general_page_meta_box', 9 );
}

if ( ! function_exists( 'emaurri_core_add_general_page_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function emaurri_core_add_general_page_meta_box_callback( $callbacks ) {
		$callbacks['page'] = 'emaurri_core_add_general_page_meta_box';

		return $callbacks;
	}

	add_filter( 'emaurri_core_filter_general_meta_box_callbacks', 'emaurri_core_add_general_page_meta_box_callback' );
}
