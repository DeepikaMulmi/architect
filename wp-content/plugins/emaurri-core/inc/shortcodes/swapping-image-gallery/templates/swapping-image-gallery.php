<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php if ( 'left' === $info_position ) { ?>
		<?php emaurri_core_template_part( 'shortcodes/swapping-image-gallery', 'templates/parts/info', '', $params ); ?>
	<?php } ?>
	<?php emaurri_core_template_part( 'shortcodes/swapping-image-gallery', 'templates/parts/slider', '', $params ); ?>
	<?php if ( empty( $info_position ) || 'right' === $info_position ) { ?>
		<?php emaurri_core_template_part( 'shortcodes/swapping-image-gallery', 'templates/parts/info', '', $params ); ?>
	<?php } ?>
</div>
