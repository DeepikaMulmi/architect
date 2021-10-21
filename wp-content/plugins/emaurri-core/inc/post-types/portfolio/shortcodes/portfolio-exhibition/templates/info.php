<article <?php post_class(); ?> id="<?php echo get_the_ID(); ?>">
	<div class="qodef-e-info">
		<div class="qodef-e-info-top">
			<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'post-info/category', '', $params ); ?>
			<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'post-info/author', '', $params ); ?>
		</div>
		<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'post-info/title', '', $params ); ?>
		<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'post-info/read-more', '', $params ); ?>
		<div class="qodef-e-portfolio-exhibition-bg-text"><?php echo emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'post-info/background-text', '', $params ); ?></div>
	</div>
</article>
