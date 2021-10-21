<?php

class QiAddonsForElementor_Admin_Notice {
	private static $instance;

	function __construct() {

		// Include scripts for plugin notice
		add_action( 'admin_enqueue_scripts', array( $this, 'register_script' ) );

		// Add admin notice
		add_action( 'admin_notices', array( $this, 'add_notice' ) );

		// Function that handles plugin notice
		add_action( 'wp_ajax_qi_adddons_for_elementor_notice', array( $this, 'handle_notice' ) );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function register_script() {
		wp_register_script( 'qi-addons-for-elementor-notice', QI_ADDONS_FOR_ELEMENTOR_ADMIN_URL_PATH . '/inc/admin-notice/assets/js/admin-plugin-statistics-notice.min.js', array( 'jquery' ), false, false );
		wp_register_style( 'qi-addons-for-elementor-notice', QI_ADDONS_FOR_ELEMENTOR_ADMIN_URL_PATH . '/inc/admin-notice/assets/css/admin-plugin-statistics-notice.min.css' );
	}

	public function add_notice() {
		$option = get_option( 'qi_addons_for_elementor_notice' );
		if( $option !== 'disallowed' && $option !== 'allowed' ) {
			qi_addons_for_elementor_framework_template_part( QI_ADDONS_FOR_ELEMENTOR_ADMIN_PATH . '/inc', 'admin-notice', 'templates/admin-notice', '', '' );

			wp_enqueue_script( 'qi-addons-for-elementor-notice' );
			wp_enqueue_style( 'qi-addons-for-elementor-notice' );
		}
	}

	public function handle_notice() {
		check_ajax_referer( 'qi-addons-for-elementor-notice-nonce', 'nonce' );

		$params = $_POST;

		if( $params['notice_action'] == 'allowed' ) {
			$this->handle_allowed_notice();
		} else if( $params['notice_action'] == 'disallowed' ) {
			$this->handle_disallowed_notice();
		} else {
			qi_addons_for_elementor_framework_get_ajax_status('fail', esc_html__('Something went wrong.', 'qi-addons-for-elementor') );
		}
	}

	private function handle_allowed_notice() {
		global $wp_version;

		$data = array(
			'plugin' => 'qi-addons-for-elementor',
			'domain' => get_site_url(),
			'date'   => date('Y-m-d H:i:s'),
			'wp_version' => $wp_version,
			'wp_language' => get_bloginfo( 'language' ),
			'php_version' => phpversion()
		);

		$current_user = wp_get_current_user();
		if( $current_user ) {
			$data['mail'] = $current_user->user_email;
		}

		$theme = $this->get_theme_info();
		if( is_array( $theme ) && count( $theme ) > 0 ){
			$data['active_theme'] = serialize( $theme );
		}

		$plugins = $this->get_active_plugins();
		if( is_array( $plugins ) && count( $plugins ) > 0 ){
			$data['active_plugins'] = serialize( $plugins );
		}

		$request_handler_url = 'https://api.qodeinteractive.com/plugin-statistics.php';

		$response = wp_remote_post(
			$request_handler_url,
			array(
				'body' => $data
			)
		);
		$response_body = json_decode( wp_remote_retrieve_body( $response ) );

		if( $response_body->success ) {
			update_option( 'qi_addons_for_elementor_notice', 'allowed', false );
			qi_addons_for_elementor_framework_get_ajax_status('success', esc_html__('Success', 'qi-addons-for-elementor') );
		} else {
			qi_addons_for_elementor_framework_get_ajax_status('fail', esc_html__('Something went wrong.', 'qi-addons-for-elementor') );
		}
	}

	private function handle_disallowed_notice() {
		update_option( 'qi_addons_for_elementor_notice', 'disallowed', false );

		qi_addons_for_elementor_framework_get_ajax_status('success', esc_html__('Success', 'qi-addons-for-elementor') );
	}

	public function get_theme_info() {
		$theme_info = wp_get_theme();

		$theme_info = array(
			'name'    => $theme_info->get( 'Name' ),
			'version' => $theme_info->get( 'Version' ),
			'author'  => $theme_info->get( 'Author' ),
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

QiAddonsForElementor_Admin_Notice::get_instance();
