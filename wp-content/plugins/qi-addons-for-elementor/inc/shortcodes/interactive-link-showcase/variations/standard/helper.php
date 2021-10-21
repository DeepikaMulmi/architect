<?php

if ( ! function_exists( 'qi_addons_for_elementor_add_interactive_link_showcase_variation_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function qi_addons_for_elementor_add_interactive_link_showcase_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'qi-addons-for-elementor' );

		return $variations;
	}

	add_filter( 'qi_addons_for_elementor_filter_interactive_link_showcase_layouts', 'qi_addons_for_elementor_add_interactive_link_showcase_variation_standard' );
}

if ( ! function_exists( 'qi_addons_for_elementor_add_interactive_link_showcase_options_standard' ) ) {
	function qi_addons_for_elementor_add_interactive_link_showcase_options_standard( $options ) {
		$standard_options = array();

		$hide_images = array(
			'field_type'    => 'select',
			'name'          => 'standard_hide_images_under',
			'title'         => esc_html__( 'Hide Images', 'qi-addons-for-elementor' ),
			'options'       => array(
				''    => esc_html__( 'Never', 'qi-addons-for-elementor' ),
				'680' => esc_html__( 'Under 680px', 'qi-addons-for-elementor' ),
				'480' => esc_html__( 'Under 480px', 'qi-addons-for-elementor' ),
			),
			'default_value' => '',
			'prefix_class'  => 'qodef-standard-hide-under--',
			'dependency'    => array(
				'show' => array(
					'layout' => array(
						'values'        => 'standard',
						'default_value' => '',
					),
				),
			),
		);

		$standard_options[] = $hide_images;

		return array_merge( $options, $standard_options );
	}

	add_filter( 'qi_addons_for_elementor_filter_interactive_link_showcase_extra_options', 'qi_addons_for_elementor_add_interactive_link_showcase_options_standard' );
}
