<?php
$role = get_post_meta( get_the_ID(), 'qodef_team_member_role', true );

if ( ! empty( $role ) ) { ?>
	<p class="qodef-e-role"><?php echo strip_tags( $role ); ?></p>
<?php } ?>
