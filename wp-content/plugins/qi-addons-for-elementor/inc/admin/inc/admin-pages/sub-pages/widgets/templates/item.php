<div class="qodef-widgets-item col-sm-12 col-md-6">
	<div class="qodef-widgets-item-top">
		<h4 class="qodef-widgets-title"><?php echo esc_attr( $shortcode['title'] ); ?></h4>
		<div class="qodef-checkbox-toggle qodef-field" data-option-name="<?php echo esc_attr( $shortcode_key ); ?>">
			<input type="checkbox" id="<?php echo esc_attr( $shortcode_key ); ?>" name="<?php echo esc_attr( $shortcode_key ); ?>" value="yes" <?php echo ( isset( $disabled[ $shortcode_key ] ) && $disabled[ $shortcode_key ] === $shortcode['base'] ) ? '' : 'checked'; ?> />
			<label for="<?php echo esc_attr( $shortcode_key ); ?>"><?php echo esc_html( $shortcode['title'] ); ?></label>
		</div>
	</div>
	<?php qi_addons_for_elementor_framework_template_part( QI_ADDONS_FOR_ELEMENTOR_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/widgets/templates/parts/demo', '', array( 'shortcode' => $shortcode ) ); ?>
	<?php qi_addons_for_elementor_framework_template_part( QI_ADDONS_FOR_ELEMENTOR_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/widgets/templates/parts/documentation', '', array( 'shortcode' => $shortcode ) ); ?>
	<?php qi_addons_for_elementor_framework_template_part( QI_ADDONS_FOR_ELEMENTOR_ADMIN_PATH . '/inc', 'admin-pages', 'sub-pages/widgets/templates/parts/video', '', array( 'shortcode' => $shortcode ) ); ?>
</div>
