<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/text-marquee/class-emaurricore-text-marquee-shortcode.php';

foreach ( glob( EMAURRI_CORE_INC_PATH . '/shortcodes/text-marquee/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
