<?php

include_once EMAURRI_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/class-emaurricore-portfolio-list-shortcode.php';

foreach ( glob( EMAURRI_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
