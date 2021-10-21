<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/custom-font/class-emaurricore-custom-font-shortcode.php';

foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
