<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/countdown/class-emaurricore-countdown-shortcode.php';

foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/countdown/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
