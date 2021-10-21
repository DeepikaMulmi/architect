<?php

include_once EMAURRI_CORE_INC_PATH . '/search/class-emaurricore-search.php';
include_once EMAURRI_CORE_INC_PATH . '/search/helper.php';
include_once EMAURRI_CORE_INC_PATH . '/search/dashboard/admin/search-options.php';

foreach ( glob( EMAURRI_CORE_INC_PATH . '/search/layouts/*/include.php' ) as $layout ) {
	include_once $layout;
}
