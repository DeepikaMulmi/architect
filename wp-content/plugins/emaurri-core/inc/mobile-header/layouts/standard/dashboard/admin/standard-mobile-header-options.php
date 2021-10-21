<?php

if ( ! function_exists( 'emaurri_core_add_standard_mobile_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_tab
	 */
	function emaurri_core_add_standard_mobile_header_options( $page, $general_tab ) {

		$section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_standard_mobile_header_section',
				'title'      => esc_html__( 'Standard Mobile Header', 'emaurri-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values'        => 'standard',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_mobile_header_height',
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
				'name'        => 'qodef_standard_mobile_header_side_padding',
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
				'name'        => 'qodef_standard_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'emaurri-core' ),
				'description' => esc_html__( 'Enter header background color', 'emaurri-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'emaurri-core' ),
				),
			)
		);
	}

	add_action( 'emaurri_core_action_after_mobile_header_options_map', 'emaurri_core_add_standard_mobile_header_options', 10, 2 );
}
