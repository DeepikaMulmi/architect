<?php
$role = get_post_meta( get_the_ID(), 'qodef_team_member_role', true );

if ( ! empty( $role ) ) { ?>
	<h5 class="qodef-team-member-role"><?php echo esc_html( $role ); ?></h5>
<?php } ?>
