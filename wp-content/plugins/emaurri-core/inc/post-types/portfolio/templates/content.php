<?php
// Hook to include additional content before page content holder
do_action( 'emaurri_core_action_before_portfolio_content_holder' );
?>
<main id="qodef-page-content" class="qodef-grid qodef-layout--template <?php echo esc_attr( emaurri_core_get_grid_gutter_classes() ); ?>">
	<div class="qodef-grid-inner clear">
		<?php
		// Include portfolio template
		$content = isset( $content ) ? $content : '';
		emaurri_core_template_part( 'post-types/portfolio', 'templates/portfolio', $content );

		// Include page content sidebar
		emaurri_core_theme_template_part( 'sidebar', 'templates/sidebar' );
		?>
	</div>
</main>
<?php
// Hook to include additional content after main page content holder
do_action( 'emaurri_core_action_after_portfolio_content_holder' );
?>
