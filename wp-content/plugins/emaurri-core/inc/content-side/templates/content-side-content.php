<div id="qodef-page-content-side-inner">

	<?php
		$custom_sidebar = emaurri_core_get_post_value_through_levels( 'qodef_content_side_custom_sidebar' );
		dynamic_sidebar( $custom_sidebar );
	?>

</div>