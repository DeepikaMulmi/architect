<div <?php qi_addons_for_elementor_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-grid-inner qodef-qi-clear">
		<?php
		// Include global masonry template from theme
		qi_addons_for_elementor_template_part( 'masonry', 'templates/sizer-gutter', '', $params['behavior'] );

		// Include items
		qi_addons_for_elementor_template_part( 'blog/shortcodes/blog-list', 'templates/loop', '', $params );
		?>
	</div>
	<?php
	// Include global pagination from theme
	qi_addons_for_elementor_template_part( 'pagination', 'templates/pagination', 'standard', $params );
	?>
</div>
