<?php

include_once EMAURRI_CORE_INC_PATH . '/social-share/shortcodes/social-share/class-emaurricore-social-share-shortcode.php';

foreach ( glob( EMAURRI_CORE_INC_PATH . '/social-share/shortcodes/social-share/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
