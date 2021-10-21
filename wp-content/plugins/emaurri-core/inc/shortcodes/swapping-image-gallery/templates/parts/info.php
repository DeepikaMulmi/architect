<div class="qodef-m-info clearfix">
	<div class="qodef-m-headline">
		<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title"><?php echo qode_framework_wp_kses_html( 'content', $info_title ); ?></<?php echo esc_attr( $title_tag ); ?>>
		<?php if ( ! empty( $info_description ) ) { ?>
			<p class="qodef-m-description"><?php echo esc_html( $info_description ); ?></p>
		<?php } ?>
	</div>
	<div class="qodef-m-thumbnails-holder qodef-grid qodef-layout--columns qodef-gutter--tiny qodef-col-num--3 qodef--no-bottom-space">
		<div class="qodef-grid-inner clear">
			<?php foreach ( $items as $image_item ) : ?>
				<div class="qodef-m-thumbnail qodef-grid-item">
					<?php echo wp_get_attachment_image( $image_item['thumbnail_image'], 'full' ); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
