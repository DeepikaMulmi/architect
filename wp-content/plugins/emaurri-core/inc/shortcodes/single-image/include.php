<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/single-image/class-emaurricore-single-image-shortcode.php';

foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/single-image/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
