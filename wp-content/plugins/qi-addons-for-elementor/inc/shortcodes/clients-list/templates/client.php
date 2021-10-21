<div <?php qi_addons_for_elementor_framework_class_attribute( $client_classes ); ?>>
	<div class="qodef-e-inner">
		<?php if ( ! empty( $client_link['url'] ) ) { ?>
			<a href="<?php echo esc_url( $client_link['url'] ); ?>" <?php echo qi_addons_for_elementor_framework_get_inline_attrs( qi_addons_for_elementor_get_link_attributes( $client_link ) ); ?>>
		<?php } ?>
		<div class="qodef-e-images-holder">
			<?php if ( ! empty( $client_main_image ) ) { ?>
				<div class="qodef-e-main-image">
					<?php echo wp_get_attachment_image( $client_main_image, $images_proportion ); ?>
				</div>
			<?php } ?>
			<?php if ( ! empty( $client_hover_image ) ) { ?>
				<div class="qodef-e-hover-image">
					<?php echo wp_get_attachment_image( $client_hover_image, $images_proportion ); ?>
				</div>
			<?php } ?>
		</div>
		<?php if ( ! empty( $client_link['url'] ) ) { ?>
			</a>
		<?php } ?>
		<?php qi_addons_for_elementor_template_part( 'shortcodes/clients-list', 'templates/parts/title', '', $params ); ?>
		<?php qi_addons_for_elementor_template_part( 'shortcodes/clients-list', 'templates/parts/text', '', $params ); ?>
	</div>
</div>
