<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		emaurri_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php

                // Include post date info
                emaurri_template_part( 'blog', 'templates/parts/post-info/date' );
				// Include post category info
				emaurri_template_part( 'blog', 'templates/parts/post-info/category' );
                // Include post author info
                emaurri_template_part( 'blog', 'templates/parts/post-info/author' );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				emaurri_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => 'h3' ) );

				// Include post excerpt
				emaurri_template_part( 'blog', 'templates/parts/post-info/excerpt' );

				// Hook to include additional content after blog single content
				do_action( 'emaurri_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<div class="qodef-e-info-left">
					<?php
					// Include post read more
					emaurri_template_part( 'blog', 'templates/parts/post-info/read-more' );
					?>
				</div>
				<div class="qodef-e-info-right">
				</div>
			</div>
		</div>
	</div>
</article>
