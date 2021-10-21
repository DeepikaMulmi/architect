<?php if ( $query_result->have_posts() ) {
	while ( $query_result->have_posts() ) : $query_result->the_post();

		emaurri_core_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'templates/info', '', $params );
	endwhile; // End of the loop.
} else {
	// Include global posts not found
	emaurri_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_query();