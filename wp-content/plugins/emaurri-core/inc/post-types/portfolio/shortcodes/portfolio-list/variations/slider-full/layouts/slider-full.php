<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-content">
			<div class="qodef-e-content-inner">
				<div class="qodef-e-info-top">
					<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/category', '', $params ); ?>
					<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/author', '', $params ); ?>
				</div>
				<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/title', '', $params ); ?>
			</div>
		</div>
		<?php emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/background', '', $params ); ?>
	</div>
</article>
