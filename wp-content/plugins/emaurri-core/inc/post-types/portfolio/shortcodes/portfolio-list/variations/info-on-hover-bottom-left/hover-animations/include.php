<?php

include_once EMAURRI_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-on-hover-bottom-left/hover-animations/hover-animations.php';

foreach ( glob( EMAURRI_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-on-hover-bottom-left/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}
