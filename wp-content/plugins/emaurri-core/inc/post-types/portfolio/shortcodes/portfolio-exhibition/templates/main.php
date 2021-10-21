<article <?php post_class(); ?> data-id="<?php echo get_the_ID(); ?>">
	<div class="qodef-e-info">
		<div class="qodef-e-info-top">
			<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'post-info/category', '', $params ); ?>
			<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'post-info/author', '', $params ); ?>
		</div>
		<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'post-info/title', '', $params ); ?>
		<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'post-info/read-more', '', $params ); ?>
	</div>
	<div class="qodef-e-image-holder">
		<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'post-info/image', '', $params ); ?>
	</div>
</article>