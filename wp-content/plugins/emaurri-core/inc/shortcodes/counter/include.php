<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/counter/class-emaurricore-counter-shortcode.php';

foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/counter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
