<?php

if ( has_post_thumbnail() ) {
	echo qi_addons_for_elementor_get_list_shortcode_item_image( $images_proportion, get_post_thumbnail_id(), intval( $custom_image_width ), intval( $custom_image_height ) );
}
