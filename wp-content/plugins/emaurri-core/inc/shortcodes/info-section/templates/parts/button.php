<?php if ( ! empty( $button_params ) && ! empty( $button_params['text'] ) && class_exists( 'EmaurriCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-m-button">
		<?php echo EmaurriCore_Button_Shortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>
