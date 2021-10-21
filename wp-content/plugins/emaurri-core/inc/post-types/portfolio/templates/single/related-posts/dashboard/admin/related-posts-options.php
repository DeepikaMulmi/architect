<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_single_related_posts_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function emaurri_core_add_portfolio_single_related_posts_options( $page ) {

		if ( $page ) {

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_portfolio_single_enable_related_posts',
					'title'         => esc_html__( 'Related Posts', 'emaurri-core' ),
					'description'   => esc_html__( 'Enabling this option will show related posts section below post content on portfolio single', 'emaurri-core' ),
					'default_value' => 'no',
				)
			);
		}
	}

	add_action( 'emaurri_core_action_after_portfolio_options_single', 'emaurri_core_add_portfolio_single_related_posts_options' );
}
