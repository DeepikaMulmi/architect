<?php

if ( ! class_exists( 'EmaurriCore_WooCommerce_YITH_Wishlist' ) ) {
	class EmaurriCore_WooCommerce_YITH_Wishlist {
		private static $instance;

		public function __construct() {

			if ( qode_framework_is_installed( 'yith-wishlist' ) ) {
				// Init
				add_action( 'after_setup_theme', array( $this, 'init' ) );
			}
		}

		/**
		 * @return EmaurriCore_WooCommerce_YITH_Wishlist
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init() {
			// Unset default templates modules
			$this->unset_templates_modules();

			// Change default templates position
			$this->change_templates_position();

			// Prevent YITH responsive list rendering
			add_filter( 'yith_wcwl_is_wishlist_responsive', array( $this, 'is_responsive' ) );
		}

		function unset_templates_modules() {
			// Remove quick view button from wishlist
			remove_all_actions( 'yith_wcwl_table_after_product_name' );
		}

		function change_templates_position() {
			// Add button element for shop pages
			add_action( 'emaurri_action_product_list_item_additional_image_content', 'emaurri_core_get_yith_wishlist_shortcode' );
			add_action( 'emaurri_core_action_product_list_item_additional_image_content', 'emaurri_core_get_yith_wishlist_shortcode' );
		}

		function is_responsive() {
			// Prevent from using wp_is_mobile and rendering responsive list instead of regular cart table
			return false;
		}
	}

	EmaurriCore_WooCommerce_YITH_Wishlist::get_instance();
}
