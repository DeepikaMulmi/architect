<?php
$tags = wp_get_post_terms( $project_id, 'portfolio-tag' );

if ( ! empty( $tags ) ) { ?>
    <div class="qodef-e-tags">
    <?php foreach ( $tags as $tag ) { ?>
        <a itemprop="url" class="qodef-e-tag" href="<?php echo esc_url( get_term_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
    <?php } ?>
    </div>
<?php } ?>