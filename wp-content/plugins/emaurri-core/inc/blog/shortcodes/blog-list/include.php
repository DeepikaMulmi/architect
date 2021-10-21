<?php

include_once EMAURRI_CORE_INC_PATH . '/blog/shortcodes/blog-list/class-emaurricore-blog-list-shortcode.php';

foreach ( glob( EMAURRI_CORE_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
