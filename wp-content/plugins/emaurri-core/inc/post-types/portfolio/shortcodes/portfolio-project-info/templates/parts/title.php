<?php
$title = get_the_title( $project_id );

if ( ! empty( $title ) ) { ?>
    <span class="qodef-e-title">
        <a itemprop="url" href="<?php echo esc_url( get_the_permalink( $project_id ) ) ?>"><?php echo esc_html( $title ); ?></a>
    </span>
<?php }