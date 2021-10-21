<?php

include_once EMAURRI_CORE_CPT_PATH . '/team/shortcodes/team-list/class-emaurricore-team-list-shortcode.php';

foreach ( glob( EMAURRI_CORE_CPT_PATH . '/team/shortcodes/team-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
