<?php

include_once EMAURRI_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-category-list/class-emaurricore-portfolio-category-list-shortcode.php';

foreach ( glob( EMAURRI_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-category-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
