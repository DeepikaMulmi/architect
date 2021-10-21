<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $slider_holder_styles ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<div class="swiper-wrapper">
		<?php
		// Include items
		if ( ! empty( $images ) ) {
			foreach ( $images as $image ) {
				emaurri_core_template_part( 'shortcodes/image-gallery', 'templates/parts/image', '', array_merge( $params, $image ) );
			}
		}
		?>
	</div>
	<?php emaurri_core_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
	<?php emaurri_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
</div>
