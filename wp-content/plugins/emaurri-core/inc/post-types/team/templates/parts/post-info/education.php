<?php
$education = get_post_meta( get_the_ID(), 'qodef_team_member_education', true );

if ( ! empty( $education ) ) { ?>
	<p class="qodef-team-member-education">
		<?php echo esc_html( $education ); ?>
	</p>
<?php } ?>
