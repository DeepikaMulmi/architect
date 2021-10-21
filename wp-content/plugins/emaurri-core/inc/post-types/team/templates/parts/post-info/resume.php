<?php
$resume = get_post_meta( get_the_ID(), 'qodef_team_member_resume', true );

if ( ! empty( $resume ) ) { ?>
	<p class="qodef-team-member-resume">
		<a href="<?php echo esc_url( $resume ); ?>" download target="_blank">
			<span>
				<?php esc_html_e( 'Download Resume', 'emaurri-core' ); ?>
			</span>
		</a>
	</p>
<?php } ?>
