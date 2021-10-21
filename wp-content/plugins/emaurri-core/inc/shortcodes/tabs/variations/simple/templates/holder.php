<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<ul class="qodef-tabs-navigation">
		<?php foreach ( $tabs_titles as $title ) { ?>
			<li>
				<a href="#qodef-tab-<?php echo sanitize_title( $title ); ?>"><?php echo esc_html( $title ); ?></a>
			</li>
		<?php } ?>
	</ul>
	<?php echo do_shortcode( $content ); ?>
</div>
