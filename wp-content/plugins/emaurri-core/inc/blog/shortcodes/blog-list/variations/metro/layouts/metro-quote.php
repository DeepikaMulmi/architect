<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		$quote_params = array(
			'title_tag'        => 'p',
			'author_title_tag' => 'h5',
		);

		// Include post format part
		emaurri_core_theme_template_part( 'blog', 'templates/parts/post-format/quote', '', $quote_params );
		?>
	</div>
</article>
