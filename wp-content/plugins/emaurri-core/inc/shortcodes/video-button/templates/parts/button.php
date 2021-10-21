<?php if ( ! empty( $video_link ) ) { ?>
	<a itemprop="url" class="qodef-m-play qodef-magnific-popup qodef-popup-item" <?php echo qode_framework_get_inline_style( $play_button_styles ); ?> href="<?php echo esc_url( $video_link ); ?>" data-type="iframe">
		<span class="qodef-m-play-inner">
			<span class="qodef-m-play-text"><?php echo esc_html__( 'play', 'emaurri-core' ); ?></span>
			<?php emaurri_core_render_svg_icon( 'video-button' ); ?>
			<?php emaurri_core_render_svg_icon( 'circle', 'qodef-svg-circle' ); ?>
			<?php emaurri_core_render_svg_icon( 'circle', 'qodef-svg-circle' ); ?>
		</span>
	</a>
<?php } ?>
