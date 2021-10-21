<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/tabs/class-emaurricore-tab-shortcode.php';
include_once EMAURRI_CORE_SHORTCODES_PATH . '/tabs/class-emaurricore-tab-child-shortcode.php';

foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/tabs/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
