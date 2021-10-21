<?php
$portfolio_list_image = get_post_meta( get_the_ID(), 'qodef_portfolio_list_image', true );
$has_image            = ! empty ( $portfolio_list_image ) || has_post_thumbnail();

if ( $has_image ) {
	$image_dimension = 'full';
	$image_url       = emaurri_core_get_list_shortcode_item_image_url( $image_dimension, $portfolio_list_image );
	?>
	<div class="qodef-e-media-image">
		<?php echo emaurri_core_get_list_shortcode_item_image( $image_dimension, $portfolio_list_image ); ?>
	</div>
<?php } ?>