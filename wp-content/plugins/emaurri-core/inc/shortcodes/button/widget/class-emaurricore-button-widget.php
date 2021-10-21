<?php

if ( ! function_exists( 'emaurri_core_add_button_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function emaurri_core_add_button_widget( $widgets ) {
		$widgets[] = 'EmaurriCore_Button_Widget';

		return $widgets;
	}

	add_filter( 'emaurri_core_filter_register_widgets', 'emaurri_core_add_button_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EmaurriCore_Button_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'emaurri_core_button',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'emaurri_core_button' );
				$this->set_name( esc_html__( 'Emaurri Button', 'emaurri-core' ) );
				$this->set_description( esc_html__( 'Add a button element into widget areas', 'emaurri-core' ) );
			}
		}

		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[emaurri_core_button $params]" ); // XSS OK
		}
	}
}
