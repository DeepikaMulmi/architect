<?php if ( ! empty( $title ) ) { ?>
	<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title" <?php qode_framework_inline_style( $title_styles ); ?>>
		<?php if ( ! empty( $link ) ) : ?>
			<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
		<?php endif; ?>
			<span class="qodef-m-title-inner">
				<span class="qodef-m-icon-wrapper">
					<?php emaurri_core_template_part( 'shortcodes/icon-with-text/variations/before-title', 'templates/parts/' . $icon_type, '', $params ); ?>
				</span>
				<span class="qodef-m-title-text">
					<?php echo esc_html( $title ); ?>
				</span>
			</span>
		<?php if ( ! empty( $link ) ) : ?>
			</a>
		<?php endif; ?>
	</<?php echo esc_attr( $title_tag ); ?>>
<?php } ?>
