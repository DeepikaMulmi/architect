<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php if ( ! empty( $link ) ) { ?>
		<a class="qodef-m-link" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"></a>
	<?php } ?>
	<div class="qodef-m-image-holder">
		<div class="qodef-m-image-holder-inner">
			<?php if ( ! empty( $initial_image_params ) ) { ?>
				<div class="qodef-m-initial-image">
					<?php echo wp_get_attachment_image( $initial_image_params['image_id'], $initial_image_params['image_size'] ); ?>
				</div>
			<?php } ?>
			<?php if ( ! empty( $hover_image_params ) ) { ?>
				<div class="qodef-m-hover-image">
					<?php echo wp_get_attachment_image( $hover_image_params['image_id'], $hover_image_params['image_size'] ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php if ( ! empty( $title ) ) { ?>
		<div class="qodef-m-title-holder">
			<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title">
				<?php echo esc_attr( $title ); ?>
			</<?php echo esc_attr( $title_tag ); ?>>
		</div>
	<?php } ?>
</div>