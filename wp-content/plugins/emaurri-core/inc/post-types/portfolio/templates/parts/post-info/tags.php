<?php
$tags = wp_get_post_terms( get_the_ID(), 'portfolio-tag' );

if ( is_array( $tags ) && count( $tags ) ) { ?>
	<div class="qodef-e qodef-info--tags">
		<span class="qodef-e-title"><?php esc_html_e( 'Tags: ', 'emaurri-core' ); ?></span>
		<div class="qodef-e-tags">
			<?php foreach ( $tags as $tag ) { ?>
				<a itemprop="url" class="qodef-e-tag" href="<?php echo esc_url( get_term_link( $tag->term_id ) ); ?>">
					<?php echo esc_html( $tag->name ); ?>
				</a>
			<?php } ?>
		</div>
	</div>
<?php } ?>
