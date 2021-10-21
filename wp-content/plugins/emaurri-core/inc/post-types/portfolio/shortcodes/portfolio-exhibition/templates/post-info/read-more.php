<div class="qodef-e-read-more">
	<?php
	$button_params = array(
		'link'          => get_the_permalink(),
		'text'          => esc_html__( 'Explore', 'emaurri-core' ),
		'button_layout' => 'outlined'
	);

	echo EmaurriCore_Button_Shortcode::call_shortcode( $button_params ); ?>
</div>