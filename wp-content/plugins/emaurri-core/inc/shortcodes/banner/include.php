<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/banner/class-emaurricore-banner-shortcode.php';

foreach ( glob( EMAURRI_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
