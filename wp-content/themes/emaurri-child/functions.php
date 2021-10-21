<?php

if ( ! function_exists( 'emaurri_child_theme_enqueue_scripts' ) ) {
	/**
	 * Function that enqueue theme's child style
	 */
	function emaurri_child_theme_enqueue_scripts() {
		$main_style = 'emaurri-main';

		wp_enqueue_style( 'emaurri-child-style', get_stylesheet_directory_uri() . '/style.css', array( $main_style ) );
	}

	add_action( 'wp_enqueue_scripts', 'emaurri_child_theme_enqueue_scripts' );
}
