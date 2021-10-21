<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h2';
?>
<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title" <?php qode_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
	<?php if ( $has_single ) { ?>
		<a itemprop="url" class="qodef-e-title-link" href="<?php the_permalink(); ?>">
	<?php } ?>
		<?php the_title(); ?>
	<?php if ( $has_single ) { ?>
		</a>
	<?php } ?>
</<?php echo esc_attr( $title_tag ); ?>>
