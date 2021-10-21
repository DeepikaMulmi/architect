<<?php echo esc_attr( $title_tag ); ?> class="qodef-accordion-title">
	<span class="qodef-tab-title"><?php echo esc_html( $title ); ?></span>
	<span class="qodef-accordion-mark">
		<span class="qodef-icon--plus">+</span>
	</span>
	<span class="qodef-m-corner qodef--top-left"></span>
	<span class="qodef-m-corner qodef--top-right"></span>
	<span class="qodef-m-corner qodef--bottom-left"></span>
	<span class="qodef-m-corner qodef--bottom-right"></span>
</<?php echo esc_attr( $title_tag ); ?>>
<div class="qodef-accordion-content">
	<div class="qodef-accordion-content-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>
