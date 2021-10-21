<?php
$image      = get_the_post_thumbnail( $project_id, 'full' );

if ( ! empty( $image ) ) { ?>
    <a itemprop="url" class="qodef-e-image" href="<?php echo esc_url( get_the_permalink( $project_id ) ); ?>"><?php echo $image; ?></a>
<?php }