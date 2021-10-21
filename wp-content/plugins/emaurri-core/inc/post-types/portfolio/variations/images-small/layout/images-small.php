<?php
// Hook to include additional content before portfolio single item
do_action( 'emaurri_core_action_before_portfolio_single_item' );
?>
	<article <?php post_class( 'qodef-portfolio-single-item qodef-variations--small qodef-e' ); ?>>
		<div class="qodef-e-inner">
			<div class="qodef-e-content qodef-grid qodef-layout--template <?php echo emaurri_core_get_grid_gutter_classes(); ?>">
				<div class="qodef-grid-inner clear">
					<div class="qodef-grid-item qodef-col--8">
						<div class="qodef-media">
							<?php emaurri_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/media' ); ?>
						</div>
					</div>
					<div class="qodef-grid-item qodef-col--4">
						<?php emaurri_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/title' ); ?>
						<?php emaurri_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/content' ); ?>
						<div class="qodef-portfolio-info">
							<?php emaurri_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
							<?php emaurri_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/date' ); ?>
							<?php emaurri_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
							<?php emaurri_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/tags' ); ?>
							<?php emaurri_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/social-share' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php
// Hook to include additional content after portfolio single item
do_action( 'emaurri_core_action_after_portfolio_single_item' );
?>
