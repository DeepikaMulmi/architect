<?php

include_once EMAURRI_CORE_CPT_PATH . '/clients/shortcodes/clients-list/class-emaurricore-clients-list-shortcode.php';

foreach ( glob( EMAURRI_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
