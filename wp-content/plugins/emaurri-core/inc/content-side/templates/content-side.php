<?php
	$width = emaurri_core_get_post_value_through_levels( 'qodef_content_side_width' );
	$topoffset = emaurri_core_get_post_value_through_levels( 'qodef_content_side_top_offset' );
	$position = emaurri_core_get_post_value_through_levels( 'qodef_content_side_position' );
	$border = emaurri_core_get_post_value_through_levels( 'qodef_content_side_enable_border' );

	$classes = array();
	$styles = array();

	$classes[] = ! empty( $position ) && 'left' === $position ? 'cs-on-left' : 'cs-on-right';
	$classes[] = ! empty( $border ) && 'yes' === $border ? 'cs-has-border' : '';

	$classes = implode( ' ', $classes );
	$addclasses = ! empty( $classes ) ? 'class="' . $classes . '"' : '';

if ( ! empty( $width ) ) {
	if ( qode_framework_string_ends_with_space_units( $width, true ) ) {
		$styles[] = 'width: ' . $width;
	} else {
		$styles[] = 'width: ' . intval( $width ) . 'px';
	}
}

if ( ! empty( $topoffset ) ) {
	if ( qode_framework_string_ends_with_space_units( $topoffset, true ) ) {
		$styles[] = 'top: ' . $topoffset;
	} else {
		$styles[] = 'width: ' . intval( $topoffset ) . 'px';
	}
}
?>

<div id="qodef-page-content-side" <?php echo $addclasses; ?> <?php qode_framework_inline_style( $styles ); ?> >
	<?php
	// hook to include additional content before page content side content
	do_action( 'emaurri_core_action_before_page_content_side_content' );

	// include module content template
	echo apply_filters( 'emaurri_core_filter_content_side_content_template', emaurri_core_get_template_part( 'content-side', 'templates/content-side-content' ) );

	// hook to include additional content after page content side  content
	do_action( 'emaurri_core_action_after_page_content_side_content' );
	?>
</div>
