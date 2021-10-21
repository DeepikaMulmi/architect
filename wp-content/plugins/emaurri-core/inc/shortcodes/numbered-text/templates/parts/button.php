<?php if ( 'yes' === $enable_button ) { ?>
	<a href="<?php echo esc_url( $button_link ); ?>" target="<?php echo esc_attr( $button_link_target ); ?>" class="qodef-m-button qodef-button qodef-layout--textual qodef-underline--center" <?php qode_framework_inline_style( $button_styles ); ?>>
		<span class="qodef-m-text"><?php echo esc_html( $button_text ); ?></span>
	</a>
<?php } ?>
