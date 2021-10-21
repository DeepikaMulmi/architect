<?php

if ( ! function_exists( 'emaurri_core_get_mobile_header_logo_image' ) ) {
	/**
	 * Function that return logo image html for current module
	 *
	 * @return string that contains html content
	 */
	function emaurri_core_get_mobile_header_logo_image() {
		$logo_height_mobile        = emaurri_core_get_post_value_through_levels( 'qodef_mobile_logo_height' );
		$logo_height               = ! empty( $logo_height_mobile ) ? $logo_height_mobile : emaurri_core_get_post_value_through_levels( 'qodef_logo_height' );
		$mobile_logo_main_image_id = emaurri_core_get_post_value_through_levels( 'qodef_mobile_logo_main' );
		$logo_main_image_id        = ! empty( $mobile_logo_main_image_id ) ? $mobile_logo_main_image_id : emaurri_core_get_post_value_through_levels( 'qodef_logo_main' );
		$customizer_logo           = emaurri_core_get_customizer_logo();

		$parameters = array(
			'logo_height'     => ! empty( $logo_height ) ? 'height:' . intval( $logo_height ) . 'px' : '',
			'logo_main_image' => '',
		);

		if ( ! empty( $logo_main_image_id ) ) {
			$logo_main_image_attr = array(
				'class'    => 'qodef-header-logo-image qodef--main',
				'itemprop' => 'image',
				'alt'      => esc_attr__( 'logo main', 'emaurri-core' ),
			);

			$image      = wp_get_attachment_image( $logo_main_image_id, 'full', false, $logo_main_image_attr );
			$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_main_image_id, $logo_main_image_attr );

			$parameters['logo_main_image'] = $image_html;
		}

		if ( ! empty( $logo_main_image_id ) ) {
			emaurri_core_template_part( 'mobile-header/templates', 'parts/mobile-logo', '', $parameters );
		} elseif ( ! empty( $customizer_logo ) ) {
			echo qode_framework_wp_kses_html( 'html', $customizer_logo );
		}
	}
}
