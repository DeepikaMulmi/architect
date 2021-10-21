<?php
// Load title image template
emaurri_core_get_page_title_image();
?>
<div class="qodef-m-content <?php echo esc_attr( emaurri_core_get_page_title_content_classes() ); ?>">
	<?php
	// Load breadcrumbs template
	emaurri_core_breadcrumbs();
	?>
</div>
