<?php if ( class_exists( 'EmaurriCore_Social_Share_Shortcode' ) ) { ?>
	<div class="qodef-e qodef-info--social-share">
		<?php
		$params = array(
			'title'  => '',
			'layout' => 'text',
		);

		echo '<span class="qodef-e-title">' . esc_html__( 'Share:', 'emaurri-core' ) . '</span>' . EmaurriCore_Social_Share_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>