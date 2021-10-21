<?php

if ( ! function_exists( 'emaurri_core_add_page_content_side_meta_box' ) ) {
	/**
	 * function that add general options for this module
	 */
	function emaurri_core_add_page_content_side_meta_box( $page ) {

		if ( $page ) {
			$custom_sidebars = emaurri_core_get_custom_sidebars( false );

			$content_side_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-content-side',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Content side Settings', 'emaurri-core' ),
					'description' => esc_html__( 'Content side layout settings', 'emaurri-core' ),
				)
			);

			$content_side_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_enable_page_content_side',
					'title'         => esc_html__( 'Enable Page Content Side', 'emaurri-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page content side area', 'emaurri-core' ),
					'options'       => emaurri_core_get_select_type_options_pool( 'no_yes' ),
					'default_value' => '',
				)
			);

			$page_content_side_section = $content_side_tab->add_section_element(
				array(
					'name'       => 'qodef_page_content_side_section',
					'title'      => esc_html__( 'Content Side Area', 'emaurri-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_content_side' => array(
								'values'        => 'no',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_content_side_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_content_side_position',
					'title'       => esc_html__( 'Content Side Position', 'emaurri-core' ),
					'options'     => array(
						'right'   => esc_html__( 'Right', 'emaurri-core' ),
						'left'    => esc_html__( 'Left', 'emaurri-core' ),
					),
				)
			);

			$page_content_side_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_content_side_enable_border',
					'title'       => esc_html__( 'Enable Border', 'emaurri-core' ),
					'options'     => emaurri_core_get_select_type_options_pool( 'yes_no' ),
				)
			);

			$page_content_side_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_content_side_width',
					'title'       => esc_html__( 'Content Side Width', 'emaurri-core' ),
				)
			);

			$page_content_side_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_content_side_top_offset',
					'title'       => esc_html__( 'Content Side Top Offset', 'emaurri-core' ),
				)
			);


			if ( ! empty( $custom_sidebars ) ) {
				$page_content_side_section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_content_side_custom_sidebar',
						'title'       => esc_html__( 'Content Side Sidebars', 'emaurri-core' ),
						'description' => esc_html__( 'Enabling this option will set page content side sidebar', 'emaurri-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			// hook to include additional options after module options
			do_action( 'emaurri_core_action_after_page_content_side_meta_box_map', $content_side_tab );
		}
	}

	add_action( 'emaurri_core_action_after_general_meta_box_map', 'emaurri_core_add_page_content_side_meta_box', 20 );
}
