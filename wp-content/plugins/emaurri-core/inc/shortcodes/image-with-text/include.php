<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/image-with-text/class-emaurricore-image-with-text-shortcode.php';

foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/image-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
