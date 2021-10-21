<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_category_options' ) ) {
	/**
	 * Function that add general taxonomy options for this module
	 */
	function emaurri_core_add_portfolio_category_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'portfolio-category' ),
				'type'  => 'taxonomy',
				'slug'  => 'portfolio-category',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_portfolio_category_image',
					'title'      => esc_html__( 'Portfolio Category Image', 'emaurri-core' ),
				)
			);
		}
	}

	add_action( 'emaurri_core_action_register_cpt_tax_fields', 'emaurri_core_add_portfolio_category_options' );
}
