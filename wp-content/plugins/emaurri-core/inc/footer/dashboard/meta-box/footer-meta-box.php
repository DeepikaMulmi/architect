<?php

if ( ! function_exists( 'emaurri_core_add_page_footer_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function emaurri_core_add_page_footer_meta_box( $page ) {

		if ( $page ) {
			$custom_sidebars = emaurri_core_get_custom_sidebars();
			$footer_columns  = apply_filters( 'emaurri_core_filter_footer_areas_columns_size', array() );

			$footer_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-footer',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Footer Settings', 'emaurri-core' ),
					'description' => esc_html__( 'Footer layout settings', 'emaurri-core' ),
				)
			);

			$footer_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_page_footer',
					'title'       => esc_html__( 'Enable Page Footer', 'emaurri-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page footer', 'emaurri-core' ),
					'options'     => emaurri_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			$page_footer_section = $footer_tab->add_section_element(
				array(
					'name'       => 'qodef_page_footer_section',
					'title'      => esc_html__( 'Footer Area', 'emaurri-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_footer' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			// General Footer Area Options

			$page_footer_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_uncovering_footer',
					'title'       => esc_html__( 'Enable Uncovering Footer', 'emaurri-core' ),
					'description' => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'emaurri-core' ),
					'options'     => emaurri_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			// Top Footer Area Section

			$page_footer_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_top_footer_area',
					'title'       => esc_html__( 'Enable Top Footer Area', 'emaurri-core' ),
					'description' => esc_html__( 'Use this option to enable/disable top footer area', 'emaurri-core' ),
					'options'     => emaurri_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			$top_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_top_footer_area_section',
					'title'      => esc_html__( 'Top Footer Area', 'emaurri-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_top_footer_area' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_in_grid',
					'title'       => esc_html__( 'Top Footer Area in Grid', 'emaurri-core' ),
					'description' => esc_html__( 'Enabling this option will set page top footer area to be in grid', 'emaurri-core' ),
					'options'     => emaurri_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			if ( isset( $footer_columns['footer_top_sidebars_number'] ) && ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				for ( $i = 1; $i <= intval( $footer_columns['footer_top_sidebars_number'] ); $i ++ ) {
					$top_footer_area_section->add_field_element(
						array(
							'field_type'  => 'select',
							'name'        => 'qodef_footer_top_area_custom_widget_' . $i,
							'title'       => sprintf( esc_html__( 'Custom Footer Top Area - Column %s', 'emaurri-core' ), $i ),
							'description' => sprintf( esc_html__( 'Widgets added here will appear in the %s column of top footer area', 'emaurri-core' ), $i ),
							'options'     => $custom_sidebars,
						)
					);
				}
			}

			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_content_alignment',
					'title'       => esc_html__( 'Content Alignment', 'emaurri-core' ),
					'description' => esc_html__( 'Set widgets content alignment inside top footer area', 'emaurri-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'emaurri-core' ),
						'left'   => esc_html__( 'Left', 'emaurri-core' ),
						'center' => esc_html__( 'Center', 'emaurri-core' ),
						'right'  => esc_html__( 'Right', 'emaurri-core' ),
					),
				)
			);

			$top_footer_area_styles_section = $top_footer_area_section->add_section_element(
				array(
					'name'  => 'qodef_top_footer_area_styles_section',
					'title' => esc_html__( 'Top Footer Area Styles', 'emaurri-core' ),
				)
			);

			$top_footer_area_styles_row = $top_footer_area_styles_section->add_row_element(
				array(
					'name'  => 'qodef_top_footer_area_styles_row',
					'title' => '',
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_padding_top',
					'title'      => esc_html__( 'Padding Top', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_padding_bottom',
					'title'      => esc_html__( 'Padding Bottom', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_side_padding',
					'title'      => esc_html__( 'Side Padding', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_top_footer_area_background_image',
					'title'      => esc_html__( 'Background Image', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'emaurri-core' ),
					),
				)
			);

			$top_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_top_footer_area_top_border_style',
					'title'      => esc_html__( 'Top Border Style', 'emaurri-core' ),
					'options'    => emaurri_core_get_select_type_options_pool( 'border_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$top_footer_area_styles_row_2 = $top_footer_area_styles_section->add_row_element(
				array(
					'name'  => 'qodef_top_footer_area_styles_row_2',
					'title' => '',
				)
			);

			$top_footer_area_styles_row_2->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_top_footer_area_widgets_margin_bottom',
					'title'       => esc_html__( 'Widgets Margin Bottom', 'emaurri-core' ),
					'description' => esc_html__( 'Set space value between widgets', 'emaurri-core' ),
					'args'        => array(
						'col_width' => 4,
					),
				)
			);

			$top_footer_area_styles_row_2->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_top_footer_area_widgets_title_margin_bottom',
					'title'       => esc_html__( 'Widgets Title Margin Bottom', 'emaurri-core' ),
					'description' => esc_html__( 'Set space value between widget title and widget content', 'emaurri-core' ),
					'args'        => array(
						'col_width' => 4,
					),
				)
			);

			// Bottom Footer Area Section

			$page_footer_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_bottom_footer_area',
					'title'       => esc_html__( 'Enable Bottom Footer Area', 'emaurri-core' ),
					'description' => esc_html__( 'Use this option to enable/disable bottom footer area', 'emaurri-core' ),
					'options'     => emaurri_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			$bottom_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_bottom_footer_area_section',
					'title'      => esc_html__( 'Bottom Footer Area', 'emaurri-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_bottom_footer_area' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_in_grid',
					'title'       => esc_html__( 'Bottom Footer Area in Grid', 'emaurri-core' ),
					'description' => esc_html__( 'Enabling this option will set page bottom footer area to be in grid', 'emaurri-core' ),
					'options'     => emaurri_core_get_select_type_options_pool( 'no_yes' ),
				)
			);

			if ( isset( $footer_columns['footer_bottom_sidebars_number'] ) && ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				for ( $i = 1; $i <= intval( $footer_columns['footer_bottom_sidebars_number'] ); $i ++ ) {
					$bottom_footer_area_section->add_field_element(
						array(
							'field_type'  => 'select',
							'name'        => 'qodef_footer_bottom_area_custom_widget_' . $i,
							'title'       => sprintf( esc_html__( 'Custom Footer Bottom Area - Column %s', 'emaurri-core' ), $i ),
							'description' => sprintf( esc_html__( 'Widgets added here will appear in the %s column of bottom footer area', 'emaurri-core' ), $i ),
							'options'     => $custom_sidebars,
						)
					);
				}
			}

			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_content_alignment',
					'title'       => esc_html__( 'Content Alignment', 'emaurri-core' ),
					'description' => esc_html__( 'Set widgets content alignment inside bottom footer area', 'emaurri-core' ),
					'options'     => array(
						''       => esc_html__( 'Default', 'emaurri-core' ),
						'left'   => esc_html__( 'Left', 'emaurri-core' ),
						'center' => esc_html__( 'Center', 'emaurri-core' ),
						'right'  => esc_html__( 'Right', 'emaurri-core' ),
					),
				)
			);

			$bottom_footer_area_styles_section = $bottom_footer_area_section->add_section_element(
				array(
					'name'  => 'qodef_bottom_footer_area_styles_section',
					'title' => esc_html__( 'Bottom Footer Area Styles', 'emaurri-core' ),
				)
			);

			$bottom_footer_area_styles_row = $bottom_footer_area_styles_section->add_row_element(
				array(
					'name'  => 'qodef_bottom_footer_area_styles_row',
					'title' => '',
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_padding_top',
					'title'      => esc_html__( 'Padding Top', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_padding_bottom',
					'title'      => esc_html__( 'Padding Bottom', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_side_padding',
					'title'      => esc_html__( 'Side Padding', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'emaurri-core' ),
					'args'       => array(
						'col_width' => 3,
						'suffix'    => esc_html__( 'px', 'emaurri-core' ),
					),
				)
			);

			$bottom_footer_area_styles_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_bottom_footer_area_top_border_style',
					'title'      => esc_html__( 'Top Border Style', 'emaurri-core' ),
					'options'    => emaurri_core_get_select_type_options_pool( 'border_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			// Hook to include additional options after module options
			do_action( 'emaurri_core_action_after_page_footer_meta_box_map', $footer_tab );
		}
	}

	add_action( 'emaurri_core_action_after_general_meta_box_map', 'emaurri_core_add_page_footer_meta_box' );
}
