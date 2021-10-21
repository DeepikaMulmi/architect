<div <?php qi_addons_for_elementor_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-inner">
		<?php
		$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h5';

		foreach ( $items as $item ) {
			$classes              = array( 'qodef-m-item', 'qodef-e' );
			$classes[]            = 'elementor-repeater-item-' . $item['_id'];
			$classes[]            = ! empty( $item['item_discount_price'] ) ? 'qodef-has-discount' : '';
			$item['classes']      = $classes;
			$item['title_tag']    = $title_tag;
			$item['border_style'] = $border_style;

			qi_addons_for_elementor_template_part( 'shortcodes/pricing-list', 'variations/' . $layout . '/templates/item', '', $item );
		}
		?>
	</div>
	<?php qi_addons_for_elementor_template_part( 'shortcodes/icon-with-text', 'templates/parts/button', '', $params ); ?>
</div>
