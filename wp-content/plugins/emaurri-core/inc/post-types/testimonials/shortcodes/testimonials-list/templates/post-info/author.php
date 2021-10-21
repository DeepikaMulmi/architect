<?php
$author     = get_post_meta( get_the_ID(), 'qodef_testimonials_author', true );
$author_job = get_post_meta( get_the_ID(), 'qodef_testimonials_author_job', true );

if ( ! empty( $author ) ) { ?>
	<span class="qodef-e-author">
		<span class="qodef-e-author-name"><?php echo esc_html__( 'By', 'emaurri-core' ); ?> <?php echo esc_html( $author ); ?></span>
		<span class="qodef-e-author-job"><?php echo esc_html( $author_job ); ?></span>
	</span>
<?php } ?>
