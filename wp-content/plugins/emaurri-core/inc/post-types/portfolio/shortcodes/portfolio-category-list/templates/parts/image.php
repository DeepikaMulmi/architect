<?php

$taxonomy = str_replace( array( '-', ' ' ), array( '_', '' ), $taxonomy );
$image    = get_term_meta( $term_id, 'qodef_' . $taxonomy . '_image', true );

if ( ! empty( $image ) ) {
	$image_dimension     = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension['size'] ) : 'full';
	$custom_image_width  = isset( $custom_image_width ) && '' !== $custom_image_width ? intval( $custom_image_width ) : 0;
	$custom_image_height = isset( $custom_image_height ) && '' !== $custom_image_height ? intval( $custom_image_height ) : 0;
	?>
	<div class="qodef-e-image">
		<a itemprop="url" class="qodef-e-image-link" href="<?php echo esc_url( get_term_link( $term_id ) ); ?>">
			<?php echo emaurri_core_get_list_shortcode_item_image( $image_dimension, $image, $custom_image_width, $custom_image_height ); ?>
		</a>
	</div>
<?php } ?>
