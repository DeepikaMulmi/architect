<?php

include_once EMAURRI_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( EMAURRI_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
