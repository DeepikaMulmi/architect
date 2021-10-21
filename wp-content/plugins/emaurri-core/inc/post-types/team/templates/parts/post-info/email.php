<?php
$email = get_post_meta( get_the_ID(), 'qodef_team_member_email', true );

if ( ! empty( $email ) ) {
	$email = str_replace( 'mailto:', '', $email );
	?>
	<a href="<?php echo esc_url( 'mailto:' . $email ); ?>" class="qodef-team-member-email" target="_self">
		<span>
			<?php echo esc_html( $email ); ?>
		</span>
	</a>
<?php } ?>
