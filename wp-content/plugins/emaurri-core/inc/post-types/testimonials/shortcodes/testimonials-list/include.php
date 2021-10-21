<?php

include_once EMAURRI_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/class-emaurricore-testimonials-list-shortcode.php';

foreach ( glob( EMAURRI_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
