<?php if ( comments_open() ) { ?>
	<div class="qodef-e-info-comments">
		<a itemprop="url" class="qodef-e-info-comments-link" href="<?php comments_link(); ?>">
			<?php comments_number( '0 ' . esc_html__( 'Comments', 'emaurri-core' ), '1 ' . esc_html__( 'Comment', 'emaurri-core' ), '% ' . esc_html__( 'Comments', 'emaurri-core' ) ); ?>
		</a>
	</div>
<?php } ?>
