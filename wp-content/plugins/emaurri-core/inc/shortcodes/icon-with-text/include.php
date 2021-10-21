<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/icon-with-text/class-emaurricore-icon-with-text-shortcode.php';

foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/icon-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
