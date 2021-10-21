<?php if ( emaurri_is_installed( 'core' ) ) {
	$params = array(
		'layout' => 'text',
	);
	?>
	<div class="qodef-e-info-item qodef-e-info-share">
		<?php emaurri_render_social_share_element( $params ); ?>
	</div>
<?php } ?>
