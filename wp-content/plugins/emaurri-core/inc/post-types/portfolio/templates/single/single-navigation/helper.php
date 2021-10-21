<?php

if ( ! function_exists( 'emaurri_core_include_portfolio_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function emaurri_core_include_portfolio_single_post_navigation_template() {
		emaurri_core_template_part( 'post-types/portfolio', 'templates/single/single-navigation/templates/single-navigation' );
	}

	add_action( 'emaurri_core_action_after_portfolio_single_item', 'emaurri_core_include_portfolio_single_post_navigation_template' );
}
