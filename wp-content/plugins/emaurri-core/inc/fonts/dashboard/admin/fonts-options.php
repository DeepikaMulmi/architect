<?php

if ( ! function_exists( 'emaurri_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function emaurri_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => EMAURRI_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'emaurri-core' ),
				'description' => esc_html__( 'Global Fonts Options', 'emaurri-core' ),
				'icon'        => 'fa fa-cog',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'emaurri-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts',
					),
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'emaurri-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'emaurri-core' ),
					'description' => esc_html__( 'Choose Google Fonts which you want to use on your website', 'emaurri-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'emaurri-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type'  => 'googlefont',
					'name'        => 'qodef_choose_google_font',
					'title'       => esc_html__( 'Google Font', 'emaurri-core' ),
					'description' => esc_html__( 'Choose Google Font', 'emaurri-core' ),
					'args'        => array(
						'include' => 'google-fonts',
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'emaurri-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts weights for your website. Impact on page load time', 'emaurri-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'emaurri-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'emaurri-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'emaurri-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'emaurri-core' ),
						'300'  => esc_html__( '300 Light', 'emaurri-core' ),
						'300i' => esc_html__( '300 Light Italic', 'emaurri-core' ),
						'400'  => esc_html__( '400 Regular', 'emaurri-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'emaurri-core' ),
						'500'  => esc_html__( '500 Medium', 'emaurri-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'emaurri-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'emaurri-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'emaurri-core' ),
						'700'  => esc_html__( '700 Bold', 'emaurri-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'emaurri-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'emaurri-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'emaurri-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'emaurri-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'emaurri-core' ),
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'emaurri-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts style for your website. Impact on page load time', 'emaurri-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'emaurri-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'emaurri-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'emaurri-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'emaurri-core' ),
						'greek'        => esc_html__( 'Greek', 'emaurri-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'emaurri-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'emaurri-core' ),
					),
				)
			);

			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'emaurri-core' ),
					'description' => esc_html__( 'Add custom fonts', 'emaurri-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'emaurri-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_ttf',
					'title'      => esc_html__( 'Custom Font TTF', 'emaurri-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_otf',
					'title'      => esc_html__( 'Custom Font OTF', 'emaurri-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff',
					'title'      => esc_html__( 'Custom Font WOFF', 'emaurri-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff2',
					'title'      => esc_html__( 'Custom Font WOFF2', 'emaurri-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_custom_font_name',
					'title'      => esc_html__( 'Custom Font Name', 'emaurri-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'emaurri_core_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'emaurri_core_action_default_options_init', 'emaurri_core_add_fonts_options', emaurri_core_get_admin_options_map_position( 'fonts' ) );
}
