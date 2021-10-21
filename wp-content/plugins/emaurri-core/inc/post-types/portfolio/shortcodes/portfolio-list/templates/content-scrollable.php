<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
    <?php
    if ( $query_result->have_posts() ) {

        $counter = 0;
        $scrollable_item = '-meta-item';
        $thumb_html = ''; ?>

        <div class="qodef-ptf-list-showcase-meta">
                <div class="qodef-ptf-list-showcase-meta-items-holder">

            <?php while ( $query_result->have_posts() ) : $query_result->the_post();
                emaurri_core_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/scrollable-meta-item', '', $params );

                $thumb_params = $params;

            endwhile; ?>

                </div> <!-- close .qodef-ptf-list-showcase-meta-items-holder -->
        </div> <!-- close .qodef-ptf-list-showcase-meta -->
        <div class="qodef-ptf-list-showcase-preview">
            <?php while ( $query_result->have_posts() ) : $query_result->the_post();
                emaurri_core_template_part('post-types/portfolio/shortcodes/portfolio-list', 'templates/scrollable-preview-item', '', $thumb_params );
            endwhile; ?>
        </div> <!-- close .qodef-ptf-list-showcase-preview -->

    <?php } else {

        // Include global posts not found
        emaurri_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
    }

    wp_reset_postdata();
    ?>
</div>