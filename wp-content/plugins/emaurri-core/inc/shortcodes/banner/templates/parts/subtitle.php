<?php if ( ! empty( $subtitle ) ) : ?>
	<?php echo '<' . esc_attr( $subtitle_tag ); ?> class="qodef-m-subtitle" <?php qode_framework_inline_style( $subtitle_styles ); ?>>
		<?php echo esc_html( $subtitle ); ?>
	<?php echo '</' . esc_attr( $subtitle_tag ); ?>>
<?php endif; ?>
