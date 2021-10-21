<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php emaurri_core_template_part( 'shortcodes/banner', 'templates/parts/image', '', $params ); ?>
	<div class="qodef-m-content">
		<div class="qodef-m-content-inner">
			<?php emaurri_core_template_part( 'shortcodes/banner', 'templates/parts/subtitle', '', $params ); ?>
			<?php emaurri_core_template_part( 'shortcodes/banner', 'templates/parts/title', '', $params ); ?>
			<?php emaurri_core_template_part( 'shortcodes/banner', 'templates/parts/text', '', $params ); ?>
		</div>
	</div>
	<?php emaurri_core_template_part( 'shortcodes/banner', 'templates/parts/link', '', $params ); ?>
</div>
