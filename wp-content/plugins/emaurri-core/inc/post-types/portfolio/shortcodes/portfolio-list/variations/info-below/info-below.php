<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_list_variation_info_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_portfolio_list_layouts', 'emaurri_core_add_portfolio_list_variation_info_below' );
}

if ( ! function_exists( 'emaurri_core_add_portfolio_list_options_info_below' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_list_options_info_below( $options ) {
		$info_below_options   = array();
		$margin_option        = array(
			'field_type' => 'text',
			'name'       => 'info_below_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'emaurri-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-below',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Layout', 'emaurri-core' ),
		);
		$info_below_options[] = $margin_option;

		return array_merge( $options, $info_below_options );
	}

	add_filter( 'emaurri_core_filter_portfolio_list_extra_options', 'emaurri_core_add_portfolio_list_options_info_below' );
}


if ( ! function_exists( 'emaurri_register_portfolio_list_variation_info_below_scripts' ) ) {
	/**
	 * Function that register module 3rd party scripts
	 */
	function emaurri_register_portfolio_list_variation_info_below_scripts() {
		wp_register_script( 'parallax-scroll', EMAURRI_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-below/assets/js/plugins/jquery.parallax-scroll.js', array( 'jquery' ), true );
	}

	add_action( 'emaurri_action_before_main_js', 'emaurri_register_portfolio_list_variation_info_below_scripts' );
}

if ( ! function_exists( 'emaurri_include_portfolio_list_variation_info_below_scripts' ) ) {
	/**
	 * Function that enqueue modules 3rd party scripts
	 *
	 * @param array $atts
	 */
	function emaurri_include_portfolio_list_variation_info_below_scripts( $atts ) {

		if ( isset( $atts['enable_parallax'] ) && 'yes' === $atts['enable_parallax'] ) {
			wp_enqueue_script( 'parallax-scroll' );
		}
	}

	add_action( 'emaurri_core_action_list_shortcodes_load_assets', 'emaurri_include_portfolio_list_variation_info_below_scripts' );
}

if ( ! function_exists( 'emaurri_register_portfolio_list_variation_info_below_scripts_for_list_shortcodes' ) ) {
	/**
	 * Function that set module 3rd party scripts for list shortcodes
	 *
	 * @param array $scripts
	 *
	 * @return array
	 */
	function emaurri_register_portfolio_list_variation_info_below_scripts_for_list_shortcodes( $scripts ) {

		$scripts['parallax-scroll'] = array(
			'registered' => true,
		);

		return $scripts;
	}

	add_filter( 'emaurri_core_filter_portfolio_list_register_assets', 'emaurri_register_portfolio_list_variation_info_below_scripts_for_list_shortcodes' );
}
