<?php
$custom_icon    = emaurri_core_get_custom_svg_opener_icon_html( 'back_to_top' );
$holder_classes = array();
if ( empty( $custom_icon ) ) {
	$holder_classes[] = 'qodef--predefined';
}
?>
<a id="qodef-back-to-top" href="#" <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<span class="qodef-back-to-top-icon">
		<?php
		if ( ! empty( $custom_icon ) ) {
			echo emaurri_core_get_custom_svg_opener_icon_html( 'back_to_top' );
		} else {
			echo emaurri_core_get_svg_icon( 'full-arrow-right' );
		}
		?>
	</span>
</a>
