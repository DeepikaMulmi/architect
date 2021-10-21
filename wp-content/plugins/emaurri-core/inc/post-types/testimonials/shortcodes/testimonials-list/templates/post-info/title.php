<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
$title     = get_post_meta( get_the_ID(), 'qodef_testimonials_title', true );

if ( ! empty( $title ) ) { ?>
	<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title" <?php qode_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
		<?php echo esc_html( $title ); ?>
	</<?php echo esc_attr( $title_tag ); ?>>
<?php } ?>
