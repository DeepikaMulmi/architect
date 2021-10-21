<?php

if ( ! function_exists( 'emaurri_core_add_icon_list_item_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function emaurri_core_add_icon_list_item_widget( $widgets ) {
		$widgets[] = 'EmaurriCore_Icon_List_Item_Widget';

		return $widgets;
	}

	add_filter( 'emaurri_core_filter_register_widgets', 'emaurri_core_add_icon_list_item_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EmaurriCore_Icon_List_Item_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'emaurri_core_icon_list_item',
					'exclude'        => array(
						'icon_type',
						'custom_icon',
					),
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'emaurri_core_icon_list_item' );
				$this->set_name( esc_html__( 'Emaurri Icon List Item', 'emaurri-core' ) );
				$this->set_description( esc_html__( 'Add a icon list item element into widget areas', 'emaurri-core' ) );
			}
		}

		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[emaurri_core_icon_list_item $params]" ); // XSS OK
		}
	}
}
