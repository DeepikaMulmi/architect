<?php if ( ! empty( $number ) ) { ?>
	<div class="qodef-m-number" <?php qode_framework_inline_style( $number_styles ); ?>><?php echo wp_kses_post( $number ); ?></div>
<?php } ?>