<?php

include_once EMAURRI_CORE_INC_PATH . '/header/top-area/class-emaurricore-top-area.php';
include_once EMAURRI_CORE_INC_PATH . '/header/top-area/helper.php';

foreach ( glob( EMAURRI_CORE_INC_PATH . '/header/top-area/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}
