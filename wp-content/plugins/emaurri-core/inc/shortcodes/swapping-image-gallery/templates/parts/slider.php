<div class="qodef-m-image-holder" <?php qode_framework_inline_attrs( $slider_data ); ?>>
	<div class="swiper-wrapper">
		<?php foreach ( $items as $image_item ) : ?>
			<?php if ( ! empty( $image_item['item_link'] ) ) { ?>
				<a class="swiper-slide" itemprop="url" href="<?php echo esc_url( $image_item['item_link'] ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
			<?php } else { ?>
				<span class="swiper-slide">
			<?php } ?>
			<?php echo wp_get_attachment_image( $image_item['main_image'], 'full' ); ?>
			<?php if ( ! empty( $image_item['item_link'] ) ) { ?>
				</a>
			<?php } else { ?>
				</span>
			<?php } ?>
		<?php endforeach; ?>
	</div>
</div>
