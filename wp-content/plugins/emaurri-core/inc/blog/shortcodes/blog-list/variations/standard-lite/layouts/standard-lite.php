<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		emaurri_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/media', '', $params );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
					// Include post date info
					emaurri_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );

					// Include post author info
					emaurri_core_theme_template_part( 'blog', 'templates/parts/post-info/author' );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				emaurri_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params );

				// Hook to include additional content after blog single content
				do_action( 'emaurri_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<div class="qodef-e-info-left">
					<?php
					// Include post read more
					emaurri_core_theme_template_part( 'blog', 'templates/parts/post-info/read-more', '', array('button_layout' => 'textual', 'text' => 'Read more') );
					?>
				</div>
				<div class="qodef-e-info-right">
				</div>
			</div>
		</div>
	</div>
</article>
