<?php
if ( has_post_thumbnail() ) { ?>
	<div class="qodef-e-media-image">
		<a itemprop="url" href="<?php the_permalink(); ?>">
			<?php echo qi_addons_for_elementor_get_list_shortcode_item_image( $images_proportion, get_post_thumbnail_id(), intval( $custom_image_width ), intval( $custom_image_height ) ); ?>
		</a>
		<?php
		// Hook to include additional content after blog post featured image
		do_action( 'qi_addons_for_elementor_action_after_post_thumbnail_image' );
		?>
	</div>
<?php } ?>
