<?php
$portfolio_list_image = get_post_meta( get_the_ID(), 'qodef_portfolio_list_image', true );
$has_image            = ! empty( $portfolio_list_image ) || has_post_thumbnail();
if ( ! empty( $portfolio_list_image ) ) {
	$background = wp_get_attachment_image_src( $portfolio_list_image, 'full' );
	if ( is_array( $background ) ) {
		$background = $background[0];
	}
} elseif ( has_post_thumbnail() ) {
	$background = get_the_post_thumbnail_url();
}

if ( $has_image ) { ?>
	<div class="qodef-e-media-image">
		<a itemprop="url" href="<?php the_permalink(); ?>">
			<div class="qodef-e-media-background" style="background-image: url(<?php echo esc_attr( $background ); ?>)"></div>
		</a>
	</div>
<?php } ?>
