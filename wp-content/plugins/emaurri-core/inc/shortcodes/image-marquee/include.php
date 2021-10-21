<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/image-marquee/class-emaurricore-image-marquee-shortcode.php';

foreach ( glob( EMAURRI_CORE_INC_PATH . '/shortcodes/image-marquee/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
