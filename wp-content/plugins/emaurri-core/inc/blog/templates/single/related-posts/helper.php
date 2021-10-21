<?php

if ( ! function_exists( 'emaurri_core_include_blog_single_related_posts_template' ) ) {
	/**
	 * Function which includes additional module on single posts page
	 */
	function emaurri_core_include_blog_single_related_posts_template() {
		if ( is_single() ) {
			include_once EMAURRI_CORE_INC_PATH . '/blog/templates/single/related-posts/templates/related-posts.php';
		}
	}

	add_action( 'emaurri_action_after_blog_post_item', 'emaurri_core_include_blog_single_related_posts_template', 25 );  // permission 25 is set to define template position
}
