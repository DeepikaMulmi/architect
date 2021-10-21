<div class="qodef-e-media">
	<?php
	switch ( get_post_format() ) {
		case 'gallery':
			emaurri_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			emaurri_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			emaurri_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			emaurri_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	}
	?>
</div>
