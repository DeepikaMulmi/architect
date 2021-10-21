<div class='qodef-ptf-list-showcase-preview-item'>

	<div class="qodef-three-columns">
		<?php
		$portfolio_media = get_post_meta( get_the_ID(), 'qodef_portfolio_media', true );

		$thumb2 = get_post_meta( get_the_ID(), 'qodef_portfolio_second_list_image', true );

		$thumb3 = get_post_meta( get_the_ID(), 'qodef_portfolio_third_list_image', true );

		?>
			<div class="qodef-e qodef-grid qodef-layout--columns qodef-responsive--custom qodef-col-num--3 qodef-col-num--680--1 qodef-col-num--480--1 qodef--no-bottom-space qodef-gutter--small">

				<a class="qodef-ptf-images-link" href="<?php echo esc_url( $this_shortcode->get_item_link() ); ?>"></a>
				<div class="qodef-grid-inner">
					<div class="qodef-grid-item">
						<?php echo emaurri_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-list', 'post-info/image', '', $params ); ?>
					</div>
					<?php if ( ! empty( $thumb2 ) ) { ?>
						<div class="qodef-grid-item"><?php echo wp_get_attachment_image( $thumb2, 'full' ); ?></div>
					<?php } ?>
					<?php if ( ! empty( $thumb3 ) ) { ?>
						<div class="qodef-grid-item"><?php echo wp_get_attachment_image( $thumb3, 'full' ); ?></div>
					<?php } ?>
				</div>
			</div>
		<div class="qodef-ptf-list-showcase-preview-title-resp">
			<a href="<?php echo esc_url( $this_shortcode->get_item_link() ); ?>"><?php the_title(); ?></a>
			<span class="qodef-ptf-meta-item-date-year"><?php the_time( 'M. Y' ); ?></span>
		</div>
	</div>
</div>
