<?php

if ( ! function_exists( 'emaurri_core_get_elementor_instance' ) ) {
	/**
	 * Function that return page builder module instance
	 */
	function emaurri_core_get_elementor_instance() {
		return \Elementor\Plugin::instance();
	}
}

if ( ! function_exists( 'emaurri_core_get_elementor_widgets_manager' ) ) {
	/**
	 * Function that return page builder widget module instance
	 */
	function emaurri_core_get_elementor_widgets_manager() {
		return emaurri_core_get_elementor_instance()->widgets_manager;
	}
}

if ( ! function_exists( 'emaurri_core_load_elementor_widgets' ) ) {
	/**
	 * Function that include modules into page builder
	 */
	function emaurri_core_load_elementor_widgets() {
        $check_code = class_exists( 'EmaurriCore_Dashboard' ) ? EmaurriCore_Dashboard::get_instance()->get_code() : true;

        if ( ! empty( $check_code ) ) {
            include_once EMAURRI_CORE_PLUGINS_PATH . '/elementor/class-emaurricore-elementor-widget-base.php';

            $widgets = array();
            foreach ( glob( EMAURRI_CORE_SHORTCODES_PATH . '/*', GLOB_ONLYDIR ) as $shortcode ) {

                if ( basename( $shortcode ) !== 'dashboard' ) {
                    $is_disabled = emaurri_core_performance_get_option_value( $shortcode, 'emaurri_core_performance_shortcode_' );

                    if ( empty( $is_disabled ) ) {
                        foreach ( glob( $shortcode . '/*-elementor.php' ) as $shortcode_load ) {
                            $widgets[ basename( $shortcode_load ) ] = $shortcode_load;
                        }
                    }
                }
            }

            foreach ( glob( EMAURRI_CORE_INC_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
                $widgets[ basename( $shortcode_load ) ] = $shortcode_load;
            }

            foreach ( glob( EMAURRI_CORE_CPT_PATH . '/*', GLOB_ONLYDIR ) as $post_type ) {

                if ( 'dashboard' !== basename( $post_type ) ) {
                    $is_disabled = emaurri_core_performance_get_option_value( $post_type, 'emaurri_core_performance_post_type_' );

                    if ( empty( $is_disabled ) ) {
                        foreach ( glob( $post_type . '/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
                            $widgets[ basename( $shortcode_load ) ] = $shortcode_load;
                        }
                    }
                }
            }

            foreach ( glob( EMAURRI_CORE_PLUGINS_PATH . '/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
                $widgets[ basename( $shortcode_load ) ] = $shortcode_load;
            }

            foreach ( glob( EMAURRI_CORE_PLUGINS_PATH . '/*/post-types/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
                $widgets[ basename( $shortcode_load ) ] = $shortcode_load;
            }

            foreach ( glob( EMAURRI_CORE_PLUGINS_PATH . '/*/roles/*/shortcodes/*/*-elementor.php' ) as $shortcode_load ) {
                $widgets[ basename( $shortcode_load ) ] = $shortcode_load;
            }

            if ( ! empty( $widgets ) ) {
                ksort( $widgets );

                foreach ( $widgets as $widget ) {
                    include_once $widget;
                }
            }
        }
	}

	add_action( 'elementor/widgets/widgets_registered', 'emaurri_core_load_elementor_widgets' );
}
