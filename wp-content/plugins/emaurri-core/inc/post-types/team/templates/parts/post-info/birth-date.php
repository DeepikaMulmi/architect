<?php
$birth_date = get_post_meta( get_the_ID(), 'qodef_team_member_birth_date', true );

if ( ! empty( $birth_date ) ) { ?>
	<p class="qodef-team-member-birth-date">
		<?php echo esc_html( $birth_date ); ?>
	</p>
<?php } ?>
