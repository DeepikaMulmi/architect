<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php emaurri_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', 'background', $params ); ?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				emaurri_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );

				// Include post author info
				emaurri_core_theme_template_part( 'blog', 'templates/parts/post-info/author' );
				?>
			</div>
			<?php emaurri_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params ); ?>
		</div>
		<?php emaurri_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/link' ); ?>
	</div>
</article>
