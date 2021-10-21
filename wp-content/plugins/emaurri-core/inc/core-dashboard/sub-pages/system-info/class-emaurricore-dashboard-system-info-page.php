<?php

if ( ! function_exists( 'emaurri_core_add_system_info_sub_page_to_list' ) ) {
	/**
	 * Function that add additional sub page item into welcome page list
	 *
	 * @param array $sub_pages
	 *
	 * @return array
	 */
	function emaurri_core_add_system_info_sub_page_to_list( $sub_pages ) {
		$sub_pages[] = 'EmaurriCore_Dashboard_System_Info_Page';

		return $sub_pages;
	}

	add_filter( 'emaurri_core_filter_add_welcome_sub_page', 'emaurri_core_add_system_info_sub_page_to_list' );
}

if ( class_exists( 'EmaurriCore_Dashboard_Sub_Page' ) ) {
	class EmaurriCore_Dashboard_System_Info_Page extends EmaurriCore_Dashboard_Sub_Page {
		private static $instance;

		public function __construct() {
			parent::__construct();
		}

		/**
		 * @return EmaurriCore_Dashboard_System_Info_Page
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function add_sub_page() {
			$this->set_base( 'system-info' );
			$this->set_title( esc_html__( 'System Info', 'emaurri-core' ) );
			$this->set_atts( $this->set_atributtes() );
		}

		public function set_atributtes() {
			return array(
				'system_info'    => $this->get_system_info(),
				'wordpress_info' => $this->get_wordpress_info(),
				'theme_info'     => $this->get_theme_information(),
				'plugins'        => $this->get_active_plugins(),
			);
		}

		public function get_system_info() {

			$system_info = array(
				'php_memory_limit'   => array(
					'title'    => esc_html__( 'PHP Memory Limit', 'emaurri-core' ),
					'value'    => size_format( wp_convert_hr_to_bytes( @ini_get( 'memory_limit' ) ) ),
					'required' => '128',
					'pass'     => wp_convert_hr_to_bytes( @ini_get( 'memory_limit' ) ) >= 134217728,
					'notice'   => esc_html__( 'The current value is insufficient to properly support the theme. Please adjust this value to 128 in order to meet the theme requirements. ', 'emaurri-core' ),
				),
				'php_version'        => array(
					'title'    => esc_html__( 'PHP Version', 'emaurri-core' ),
					'value'    => phpversion(),
					'required' => '5.6',
					'pass'     => version_compare( PHP_VERSION, '5.6.0' ) >= 0,
				),
				'php_post_max_size'  => array(
					'title'    => esc_html__( 'PHP Post Max Size', 'emaurri-core' ),
					'value'    => ini_get( 'post_max_size' ),
					'required' => '256',
					'pass'     => ini_get( 'post_max_size' ) >= 256,
					'notice'   => esc_html__( 'The current value is insufficient to properly support the theme. Please adjust this value to 256 in order to meet the theme requirements. ', 'emaurri-core' ),
				),
				'php_time_limit'     => array(
					'title'    => esc_html__( 'PHP Time Limit', 'emaurri-core' ),
					'value'    => ini_get( 'max_execution_time' ),
					'required' => '300',
					'pass'     => ini_get( 'max_execution_time' ) >= 300,
					'notice'   => esc_html__( 'The current value is insufficient to properly support the theme. Please adjust this value to 300 in order to meet the theme requirements. ', 'emaurri-core' ),
				),
				'php_max_input_vars' => array(
					'title'    => esc_html__( 'PHP Max Input Vars', 'emaurri-core' ),
					'value'    => ini_get( 'max_input_vars' ),
					'required' => '5000',
					'pass'     => ini_get( 'max_input_vars' ) >= 5000,
					'notice'   => esc_html__( 'The current value is insufficient to properly support the theme. Please adjust this value to 5000 in order to meet the theme requirements. ', 'emaurri-core' ),
				),
				'max_upload_size'    => array(
					'title'    => esc_html__( 'Max Upload Size', 'emaurri-core' ),
					'value'    => size_format( wp_max_upload_size() ),
					'required' => '128',
					'pass'     => wp_max_upload_size() >= 134217728,
					'notice'   => esc_html__( 'The current value is insufficient to properly support the theme. Please adjust this value to 128 in order to meet the theme requirements. ', 'emaurri-core' ),
				),
				'suhosin_installed'  => array(
					'title'    => esc_html__( 'SUHOSIN Installed', 'emaurri-core' ),
					'value'    => ( extension_loaded( 'suhosin' ) ) ? '<span class="dashicons dashicons-yes"></span>' : '<span class="dashicons dashicons-no"></span>',
					'required' => '',
				),
			);

			return $system_info;
		}

		public function get_wordpress_info() {
			global $wp_version;

			$wordpreess_info = array(
				'home_url'      => array(
					'title' => esc_html__( 'Home URL', 'emaurri-core' ),
					'value' => get_site_url(),
				),
				'site_url'      => array(
					'title' => esc_html__( 'Site URL', 'emaurri-core' ),
					'value' => get_site_url(),
				),
				'wp_version'    => array(
					'title' => esc_html__( 'WP Version', 'emaurri-core' ),
					'value' => $wp_version,
				),
				'wp_debug_mode' => array(
					'title' => esc_html__( 'WP Debug Mode', 'emaurri-core' ),
					'value' => ( WP_DEBUG ) ? 'Enabled' : 'Disabled',
				),
				'wp_language'   => array(
					'title' => esc_html__( 'Language', 'emaurri-core' ),
					'value' => get_bloginfo( 'language' ),
				),
			);

			return $wordpreess_info;
		}

		public function get_theme_information() {
			$theme_info = wp_get_theme();

			$theme_info = array(
				'name'    => array(
					'title' => esc_html__( 'Theme Name', 'emaurri-core' ),
					'value' => $theme_info->get( 'Name' ),
				),
				'version' => array(
					'title' => esc_html__( 'Theme Version', 'emaurri-core' ),
					'value' => $theme_info->get( 'Version' ),
				),
				'author'  => array(
					'title' => esc_html__( 'Theme Author', 'emaurri-core' ),
					'value' => $theme_info->get( 'Author' ),
				),
			);

			return $theme_info;
		}

		public function get_active_plugins() {
			$active_plugins = array();
			$plugins        = get_plugins();

			foreach ( $plugins as $plugin_file => $plugin_data ) {
				if ( is_plugin_active( $plugin_file ) ) {
					$active_plugins[ $plugin_file ]['title']      = $plugin_data['Title'];
					$active_plugins[ $plugin_file ]['url']        = $plugin_data['PluginURI'];
					$active_plugins[ $plugin_file ]['author']     = $plugin_data['Author'];
					$active_plugins[ $plugin_file ]['author_url'] = $plugin_data['AuthorURI'];
					$active_plugins[ $plugin_file ]['version']    = $plugin_data['Version'];
				}
			}

			return $active_plugins;
		}
	}
}
