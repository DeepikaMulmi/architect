<?php

if ( ! function_exists( 'emaurri_core_add_standard_header_meta' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function emaurri_core_add_standard_header_meta( $page ) {
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_standard_header_section',
				'title'      => esc_html__( 'Standard Header', 'emaurri-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => array( '', 'standard' ),
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'emaurri-core' ),
				'description'   => esc_html__( 'Set content to be in grid', 'emaurri-core' ),
				'default_value' => '',
				'options'       => emaurri_core_get_select_type_options_pool( 'no_yes' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
				'title'       => esc_html__( 'Header Height', 'emaurri-core' ),
				'description' => esc_html__( 'Enter header height', 'emaurri-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'emaurri-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'emaurri-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'emaurri-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'emaurri-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'emaurri-core' ),
				'description' => esc_html__( 'Enter header background color', 'emaurri-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'emaurri-core' ),
				'description' => esc_html__( 'Enter header border color', 'emaurri-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_border_width',
				'title'       => esc_html__( 'Header Border Width', 'emaurri-core' ),
				'description' => esc_html__( 'Enter header border width size', 'emaurri-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'emaurri-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_standard_header_border_style',
				'title'       => esc_html__( 'Header Border Style', 'emaurri-core' ),
				'description' => esc_html__( 'Choose header border style', 'emaurri-core' ),
				'options'     => emaurri_core_get_select_type_options_pool( 'border_style' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'emaurri-core' ),
				'default_value' => '',
				'options'       => array(
					''       => esc_html__( 'Default', 'emaurri-core' ),
					'left'   => esc_html__( 'Left', 'emaurri-core' ),
					'center' => esc_html__( 'Center', 'emaurri-core' ),
					'right'  => esc_html__( 'Right', 'emaurri-core' ),
				),
			)
		);
	}

	add_action( 'emaurri_core_action_after_page_header_meta_map', 'emaurri_core_add_standard_header_meta' );
}
