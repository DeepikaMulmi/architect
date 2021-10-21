<?php
$address = get_post_meta( get_the_ID(), 'qodef_team_member_address', true );

if ( ! empty( $address ) ) { ?>
	<p class="qodef-team-member-address">
		<?php echo esc_html( $address ); ?>
	</p>
<?php } ?>
