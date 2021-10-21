<?php

include_once EMAURRI_CORE_SHORTCODES_PATH . '/info-section/class-emaurricore-info-section-shortcode.php';

foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/info-section/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
