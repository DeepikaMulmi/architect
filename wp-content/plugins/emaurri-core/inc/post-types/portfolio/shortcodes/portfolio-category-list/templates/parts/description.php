<?php
$description = get_term_field( 'description', $term_id );

if ( ! empty( $description ) ) { ?>
	<p itemprop="description" class="qodef-e-description"><?php echo esc_html( strip_tags( $description ) ); ?></p>
<?php } ?>
