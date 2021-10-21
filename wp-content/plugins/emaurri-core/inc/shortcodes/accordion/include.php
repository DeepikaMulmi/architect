<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/accordion/class-emaurricore-accordion-shortcode.php';
include_once EMAURRI_CORE_SHORTCODES_PATH . '/accordion/class-emaurricore-accordion-child-shortcode.php';

foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/accordion/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
