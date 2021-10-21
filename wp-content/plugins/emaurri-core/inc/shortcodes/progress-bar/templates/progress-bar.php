<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attrs( $data_attrs ); ?>>
	<div class="qodef-m-inner">
		<div class="qodef-m-canvas">
			<?php
			if ( 'custom' === $layout && ! empty( $custom_shape ) ) {
				echo qode_framework_wp_kses_html( 'html', rawurldecode( base64_decode( $custom_shape ) ) );
			}
			?>
		</div>
		<?php if ( ! empty( $title ) ) { ?>
			<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>><?php echo qode_framework_wp_kses_html( 'content', $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
		<?php } ?>
	</div>
</div>
