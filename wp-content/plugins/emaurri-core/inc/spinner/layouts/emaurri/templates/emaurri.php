<?php
$qodef_spinner_text = emaurri_core_get_post_value_through_levels( 'qodef_spinner_text', qode_framework_get_page_id() );
?>

<div class="qodef-m-emaurri">
	<span class="qodef-m-emaurri-text">
	<?php
	$str_array = str_split( $qodef_spinner_text );
	foreach ( $str_array as $item ) :
		echo '<span>' . $item . '</span>';
	endforeach;
	?>
	</span>
</div>
