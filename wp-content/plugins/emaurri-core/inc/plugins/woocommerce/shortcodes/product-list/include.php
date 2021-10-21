<?php

include_once EMAURRI_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/class-emaurricore-product-list-shortcode.php';

foreach ( glob( EMAURRI_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
