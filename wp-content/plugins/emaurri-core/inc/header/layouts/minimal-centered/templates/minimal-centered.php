<div class="qodef-minimal-centered-header-left-wrapper">
	<?php
		// Include widget area one
		emaurri_core_get_header_widget_area();
	?>
</div>
<?php
// Include logo
emaurri_core_get_header_logo_image();
?>
<div class="qodef-minimal-centered-header-right-wrapper">
	<?php
		emaurri_core_get_opener_icon_html(
			array(
				'option_name'  => 'fullscreen_menu',
				'custom_class' => 'qodef-fullscreen-menu-opener',
			),
			true
		);
		?>
</div>
