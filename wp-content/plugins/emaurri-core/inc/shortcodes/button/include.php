<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/button/class-emaurricore-button-shortcode.php';

foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
