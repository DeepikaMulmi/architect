<?php

if ( ! function_exists( 'emaurri_core_add_back_to_top_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function emaurri_core_add_back_to_top_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_back_to_top',
					'title'         => esc_html__( 'Enable Back to Top', 'emaurri-core' ),
					'default_value' => 'yes',
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_back_to_top_icon_svg_path',
					'title'       => esc_html__( 'Back to Top Icon SVG Path', 'emaurri-core' ),
					'description' => esc_html__( 'Enter your back to top icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'emaurri-core' ),
					'dependency'  => array(
						'show' => array(
							'qodef_back_to_top' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							),
						),
					),
				)
			);

			$back_to_top_section = $page->add_section_element(
				array(
					'name'       => 'qodef_back_to_top_section',
					'title'      => esc_html__( 'Back to Top Styles', 'emaurri-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_back_to_top' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							),
						),
					),
				)
			);

			$back_to_top_row = $back_to_top_section->add_row_element(
				array(
					'name' => 'qodef_back_to_top_row',
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_color',
					'title'      => esc_html__( 'Color', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_hover_color',
					'title'      => esc_html__( 'Hover Color', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_background_color',
					'title'      => esc_html__( 'Background Color', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_background_hover_color',
					'title'      => esc_html__( 'Background Hover Color', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_border_color',
					'title'      => esc_html__( 'Border Color', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_back_to_top_border_hover_color',
					'title'      => esc_html__( 'Border Hover Color', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_back_to_top_border_width',
					'title'      => esc_html__( 'Border Width', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => 'px',
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_back_to_top_border_radius',
					'title'      => esc_html__( 'Border Radius', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$back_to_top_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_back_to_top_icon_size',
					'title'      => esc_html__( 'Icon Size', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => 'px',
					),
				)
			);
		}
	}

	add_action( 'emaurri_core_action_after_general_options_map', 'emaurri_core_add_back_to_top_options', 15 );
}
