<?php

if ( ! function_exists( 'emaurri_core_add_instagram_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function emaurri_core_add_instagram_list_widget( $widgets ) {
		if ( qode_framework_is_installed( 'instagram' ) ) {
			$widgets[] = 'EmaurriCore_Instagram_List_Widget';
		}

		return $widgets;
	}

	add_filter( 'emaurri_core_filter_register_widgets', 'emaurri_core_add_instagram_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EmaurriCore_Instagram_List_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'emaurri-core' ),
				)
			);
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'emaurri_core_instagram_list',
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'emaurri_core_instagram_list' );
				$this->set_name( esc_html__( 'Emaurri Instagram List', 'emaurri-core' ) );
				$this->set_description( esc_html__( 'Add a instagram list element into widget areas', 'emaurri-core' ) );
			}
		}

		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[emaurri_core_instagram_list $params]" ); // XSS OK
		}
	}
}
