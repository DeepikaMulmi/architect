<?php

if ( ! function_exists( 'emaurri_core_add_side_area_opener_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function emaurri_core_add_side_area_opener_widget( $widgets ) {
		$widgets[] = 'EmaurriCore_Side_Area_Opener_Widget';

		return $widgets;
	}

	add_filter( 'emaurri_core_filter_register_widgets', 'emaurri_core_add_side_area_opener_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class EmaurriCore_Side_Area_Opener_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'emaurri_core_side_area_opener' );
			$this->set_name( esc_html__( 'Emaurri Side Area Opener', 'emaurri-core' ) );
			$this->set_description( esc_html__( 'Display a "hamburger" icon that opens the side area', 'emaurri-core' ) );
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'sidea_area_opener_margin',
					'title'       => esc_html__( 'Opener Margin', 'emaurri-core' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left', 'emaurri-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'sidea_area_opener_padding',
					'title'       => esc_html__( 'Opener Padding', 'emaurri-core' ),
					'description' => esc_html__( 'Insert padding in format: top right bottom left', 'emaurri-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'side_area_opener_color',
					'title'      => esc_html__( 'Opener Color', 'emaurri-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'side_area_opener_hover_color',
					'title'      => esc_html__( 'Opener Hover Color', 'emaurri-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'side_area_opener_border',
					'title'      => esc_html__( 'Opener border', 'emaurri-core' ),
					'options'    => array(
						''      => esc_html__( 'None', 'emaurri-core' ),
						'left' => esc_html__( 'Left', 'emaurri-core' ),
						'right' => esc_html__( 'Right', 'emaurri-core' ),
					),
				)
			);
		}

		public function render( $atts ) {
			$styles = array();

			if ( ! empty( $atts['side_area_opener_color'] ) ) {
				$styles[] = 'color: ' . $atts['side_area_opener_color'] . ';';
			}

			if ( ! empty( $atts['sidea_area_opener_margin'] ) ) {
				$styles[] = 'margin: ' . $atts['sidea_area_opener_margin'];
			}

			if ( ! empty( $atts['sidea_area_opener_padding'] ) ) {
				$styles[] = 'padding: ' . $atts['sidea_area_opener_padding'];
			}

			if ( ! empty( $atts['side_area_opener_border'] ) ) {
				if ( 'left' === ( $atts['side_area_opener_border'] ) ) {
					$styles[] = 'border-left-width: 1px';
					$styles[] = 'border-left-style: solid';
				}

				if ( 'right' === ( $atts['side_area_opener_border'] ) ) {
					$styles[] = 'border-right-width: 1px';
					$styles[] = 'border-right-style: solid';
				}
			}

			emaurri_core_get_opener_icon_html(
				array(
					'option_name'  => 'side_area',
					'custom_class' => 'qodef-side-area-opener',
					'inline_style' => $styles,
					'inline_attr'  => qode_framework_get_inline_attr( $atts['side_area_opener_hover_color'], 'data-hover-color' ),
				)
			);
		}
	}
}
