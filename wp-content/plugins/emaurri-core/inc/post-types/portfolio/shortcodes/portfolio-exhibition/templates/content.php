<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-slides-info-holder">
		<?php
		// Include items
		emaurri_core_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'templates/loop', 'info', $params );
		?>
	</div>
	<div class="qodef-slides-main-holder">
		<?php
		// Include items
		emaurri_core_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'templates/loop', 'main', $params );
		?>
	</div>
</div>