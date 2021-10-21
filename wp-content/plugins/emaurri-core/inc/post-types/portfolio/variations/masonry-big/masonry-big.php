<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_single_variation_masonry_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_single_variation_masonry_big( $variations ) {
		$variations['masonry-big'] = esc_html__( 'Masonry - Big', 'emaurri-core' );

		return $variations;
	}

	add_filter( 'emaurri_core_filter_portfolio_single_layout_options', 'emaurri_core_add_portfolio_single_variation_masonry_big' );
}

if ( ! function_exists( 'emaurri_core_include_masonry_for_portfolio_single_variation_masonry_big' ) ) {
	/**
	 * Function that include masonry scripts for current module layout
	 *
	 * @param string $post_type
	 *
	 * @return string
	 */
	function emaurri_core_include_masonry_for_portfolio_single_variation_masonry_big( $post_type ) {
		$portfolio_template = emaurri_core_get_post_value_through_levels( 'qodef_portfolio_single_layout' );

		if ( 'masonry-big' === $portfolio_template ) {
			$post_type = 'portfolio-item';
		}

		return $post_type;
	}

	add_filter( 'emaurri_filter_allowed_post_type_to_enqueue_masonry_scripts', 'emaurri_core_include_masonry_for_portfolio_single_variation_masonry_big' );
}
