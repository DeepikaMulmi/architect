<?php
$border_hover_styles = array();
if ( isset( $data_attrs['data-hover-border-color'] ) ) {
	$border_hover_styles[] = 'background-color: ' . $data_attrs['data-hover-border-color'];
	unset( $data_attrs['data-hover-border-color'] );
}
?>
<a <?php qode_framework_class_attribute( $holder_classes ); ?> href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>" <?php qode_framework_inline_attrs( $data_attrs ); ?> <?php qode_framework_inline_style( $styles ); ?>>
	<span class="qodef-m-text"><?php echo esc_html( $text ); ?></span>
	<span class="qodef-m-corner qodef--top-left" <?php qode_framework_inline_style( $corner_styles ); ?>></span>
	<span class="qodef-m-corner qodef--top-right" <?php qode_framework_inline_style( $corner_styles ); ?>></span>
	<span class="qodef-m-corner qodef--bottom-left" <?php qode_framework_inline_style( $corner_styles ); ?>></span>
	<span class="qodef-m-corner qodef--bottom-right" <?php qode_framework_inline_style( $corner_styles ); ?>></span>
	<span class="qodef-m-btn-line qodef-btn-line--top" <?php qode_framework_inline_style( $border_hover_styles ); ?>></span>
	<span class="qodef-m-btn-line qodef-btn-line--right" <?php qode_framework_inline_style( $border_hover_styles ); ?>></span>
	<span class="qodef-m-btn-line qodef-btn-line--bottom" <?php qode_framework_inline_style( $border_hover_styles ); ?>></span>
	<span class="qodef-m-btn-line qodef-btn-line--left" <?php qode_framework_inline_style( $border_hover_styles ); ?>></span>
</a>
