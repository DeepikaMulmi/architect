<?php

if ( ! function_exists( 'emaurri_core_add_page_content_side_options' ) ) {
	/**
	 * function that add general options for this module
	 */
	function emaurri_core_add_page_content_side_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => EMAURRI_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'content-side',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Content side', 'emaurri-core' ),
				'description' => esc_html__( 'Global settings related to page content side', 'emaurri-core' )
			)
		);

		if ( $page ) {
			$custom_sidebars = emaurri_core_get_custom_sidebars( false );

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_content_side',
					'title'         => esc_html__( 'Enable Page Content side', 'emaurri-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page content side widget area', 'emaurri-core' ),
					'default_value' => 'no',
				)
			);

			$page_content_side_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_content_side_section',
					'title'      => esc_html__( 'Content Side Area', 'emaurri-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_content_side' => array(
								'values'        => 'no',
								'default_value' => 'no',
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
						'title'       => esc_html__( 'Custom Sidebar', 'emaurri-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display in content side area', 'emaurri-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			// hook to include additional options after module options
			do_action( 'emaurri_core_action_after_page_content_side_options_map', $page );
		}
	}

	add_action( 'emaurri_core_action_default_options_init', 'emaurri_core_add_page_content_side_options', emaurri_core_get_admin_options_map_position( 'content-side' ) );
}