<?php

if ( ! function_exists( 'emaurri_core_add_page_social_share_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function emaurri_core_add_page_social_share_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => EMAURRI_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'social-share',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Social Share', 'emaurri-core' ),
				'description' => esc_html__( 'Global Social Share Options', 'emaurri-core' ),
			)
		);

		if ( $page ) {
			$social_networks = emaurri_core_social_networks_list();

			foreach ( $social_networks as $network => $params ) {
				$page->add_field_element(
					array(
						'field_type'    => 'yesno',
						'name'          => 'qodef_enable_share_' . $network,
						'title'         => sprintf( esc_html__( 'Enable %s Share', 'emaurri-core' ), $params['label'] ),
						'default_value' => 'yes',
					)
				);

				if ( 'twitter' === $network ) {
					$page->add_field_element(
						array(
							'field_type'    => 'text',
							'name'          => 'qodef_twitter_via',
							'title'         => esc_html__( 'Twitter Via Text', 'emaurri-core' ),
							'default_value' => esc_html__( '@QodeInteractive', 'emaurri-core' ),
							'dependency'    => array(
								'show' => array(
									'qodef_enable_share_twitter' => array(
										'values'        => 'yes',
										'default_value' => 'yes',
									),
								),
							),
						)
					);
				}
			}

			// Hook to include additional options after module options
			do_action( 'emaurri_core_action_after_social_share_options_map', $page );
		}
	}

	add_action( 'emaurri_core_action_default_options_init', 'emaurri_core_add_page_social_share_options', emaurri_core_get_admin_options_map_position( 'social-share' ) );
}
