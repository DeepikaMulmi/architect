<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_style( $holder_style ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<div class="swiper-wrapper">
		<?php
		// Include items
		emaurri_core_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/loop', '', $params );
		?>
	</div>
	<?php emaurri_core_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
	<?php emaurri_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
</div>
