<?php if ( ! post_password_required() && class_exists( 'EmaurriCore_Button_Shortcode' ) ) { ?>
	<div class="qodef-e-read-more">
		<?php
		$button_params = array(
			'link' => get_the_permalink(),
			'text' => esc_html__( 'Read More', 'emaurri-core' ),
		);

		echo EmaurriCore_Button_Shortcode::call_shortcode( $button_params );
		?>
	</div>
<?php } ?>
