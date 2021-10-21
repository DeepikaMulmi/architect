<?php

if ( ! function_exists( 'emaurri_core_add_button_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function emaurri_core_add_button_shortcode( $shortcodes ) {
		$shortcodes[] = 'EmaurriCore_Button_Shortcode';

		return $shortcodes;
	}

	add_filter( 'emaurri_core_filter_register_shortcodes', 'emaurri_core_add_button_shortcode', 9 );
}

if ( class_exists( 'EmaurriCore_Shortcode' ) ) {
	class EmaurriCore_Button_Shortcode extends EmaurriCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'emaurri_core_filter_button_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EMAURRI_CORE_SHORTCODES_URL_PATH . '/button' );
			$this->set_base( 'emaurri_core_button' );
			$this->set_name( esc_html__( 'Button', 'emaurri-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays button with provided parameters', 'emaurri-core' ) );
			$this->set_category( esc_html__( 'Emaurri Core', 'emaurri-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'emaurri-core' ),
				)
			);

			$options_map = emaurri_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'button_layout',
					'title'         => esc_html__( 'Layout', 'emaurri-core' ),
					'options'       => $this->get_layouts(),
					'default_value' => $options_map['default_value'],
					'visibility'    => array(
						'map_for_page_builder' => $options_map['visibility'],
						'map_for_widget'       => $options_map['visibility'],
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'size',
					'title'      => esc_html__( 'Size', 'emaurri-core' ),
					'options'    => array(
						''      => esc_html__( 'Normal', 'emaurri-core' ),
						'small' => esc_html__( 'Small', 'emaurri-core' ),
						'large' => esc_html__( 'Large', 'emaurri-core' ),
						'full'  => esc_html__( 'Normal Full Width', 'emaurri-core' ),
					),
					'dependency' => array(
						'hide' => array(
							'button_layout' => array(
								'values'        => 'textual',
								'default_value' => 'filled',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'text',
					'title'      => esc_html__( 'Button Text', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'link',
					'title'      => esc_html__( 'Button Link', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'target',
					'title'         => esc_html__( 'Target', 'emaurri-core' ),
					'options'       => emaurri_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'color',
					'title'      => esc_html__( 'Text Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Style', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'name'       => 'hover_color',
					'field_type' => 'color',
					'title'      => esc_html__( 'Text Hover Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Style', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'background_color',
					'title'      => esc_html__( 'Background Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Style', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'hover_background_color',
					'title'      => esc_html__( 'Background Hover Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Style', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'border_color',
					'title'      => esc_html__( 'Border Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Style', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'hover_border_color',
					'title'      => esc_html__( 'Border Hover Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Style', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'corner_color',
					'title'      => esc_html__( 'Corner Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Style', 'emaurri-core' ),
					'dependency' => array(
						'show' => array(
							'button_layout' => array(
								'values'        => 'outlined',
								'default_value' => 'filled',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'hover_corner_color',
					'title'      => esc_html__( 'Corner Hover Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Style', 'emaurri-core' ),
					'dependency' => array(
						'show' => array(
							'button_layout' => array(
								'values'        => 'outlined',
								'default_value' => 'filled',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'margin',
					'title'      => esc_html__( 'Margin', 'emaurri-core' ),
					'group'      => esc_html__( 'Style', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'padding',
					'title'      => esc_html__( 'Padding', 'emaurri-core' ),
					'group'      => esc_html__( 'Style', 'emaurri-core' ),
				)
			);
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'font_size',
				'title'      => esc_html__( 'Font Size', 'emaurri-core' ),
				'group'      => esc_html__( 'Typography', 'emaurri-core' ),
			) );
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'font_weight',
					'title'      => esc_html__( 'Font Weight', 'emaurri-core' ),
					'options'    => emaurri_core_get_select_type_options_pool( 'font_weight' ),
					'group'      => esc_html__( 'Typography', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'text_transform',
					'title'      => esc_html__( 'Text Transform', 'emaurri-core' ),
					'options'    => emaurri_core_get_select_type_options_pool( 'text_transform' ),
					'group'      => esc_html__( 'Typography', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'underline_position',
					'title'         => esc_html__( 'Underline Position', 'emaurri-core' ),
					'options'       => array(
						'default' => esc_html__( 'Default', 'emaurri-core' ),
						'center'  => esc_html__( 'Center', 'emaurri-core' ),
						'right'   => esc_html__( 'Right', 'emaurri-core' ),
					),
					'default_value' => 'default',
					'dependency'    => array(
						'show' => array(
							'button_layout' => array(
								'values'        => 'textual',
								'default_value' => 'filled',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'html_type',
					'title'         => esc_html__( 'HTML Type', 'emaurri-core' ),
					'options'       => array(
						'default' => esc_html__( 'Default', 'emaurri-core' ),
						'input'   => esc_html__( 'Input', 'emaurri-core' ),
						'submit'  => esc_html__( 'Submit', 'emaurri-core' ),
					),
					'default_value' => 'default',
					'visibility'    => array(
						'map_for_page_builder' => false,
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'input_name',
					'title'      => esc_html__( 'Input Name', 'emaurri-core' ),
					'visibility' => array(
						'map_for_page_builder' => false,
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'array',
					'name'       => 'custom_attrs',
					'title'      => esc_html__( 'Custom Data Attributes', 'emaurri-core' ),
					'visibility' => array(
						'map_for_page_builder' => false,
					),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'emaurri_core_button', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {

			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']    = $this->get_holder_classes( $atts );
			$atts['data_attrs']        = $this->get_data_attrs( $atts );
			$atts['styles']            = $this->get_styles( $atts );
			$atts['corner_styles']     = $this->get_corner_styles( $atts );

			return emaurri_core_get_template_part( 'shortcodes/button', 'variations/' . $atts['button_layout'] . '/templates/' . $atts['html_type'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-button';
			$holder_classes[] = ! empty( $atts['button_layout'] ) ? 'qodef-layout--' . $atts['button_layout'] : '';
			$holder_classes[] = ! empty( $atts['size'] ) ? 'qodef-size--' . $atts['size'] : '';
			$holder_classes[] = ! empty( $atts['underline_position'] ) ? 'qodef-underline--' . $atts['underline_position'] : '';
			$holder_classes[] = 'default' === $atts['html_type'] ? 'qodef-html--link' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_data_attrs( $atts ) {
			$data = array();

			if ( ! empty( $atts['hover_color'] ) ) {
				$data['data-hover-color'] = $atts['hover_color'];
			}

			if ( ! empty( $atts['hover_background_color'] ) ) {
				$data['data-hover-background-color'] = $atts['hover_background_color'];
			}

			if ( ! empty( $atts['hover_border_color'] ) ) {
				$data['data-hover-border-color'] = $atts['hover_border_color'];
			}

			if ( ! empty( $atts['hover_corner_color'] ) ) {
				$data['data-hover-corner-color'] = $atts['hover_corner_color'];
			}

			if ( ! empty( $atts['custom_attrs'] ) && is_array( $atts['custom_attrs'] ) ) {
				$data = array_merge( $data, $atts['custom_attrs'] );
			}

			return $data;
		}

		private function get_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['color'] ) ) {
				$styles[] = 'color: ' . $atts['color'];
			}

			if ( ! empty( $atts['background_color'] ) && 'outlined' !== $atts['button_layout'] && 'textual' !== $atts['button_layout'] ) {
				$styles[] = 'background-color: ' . $atts['background_color'];
			}

			if ( ! empty( $atts['border_color'] ) && 'textual' !== $atts['button_layout'] ) {
				$styles[] = 'border-color: ' . $atts['border_color'];
			}

			if ( ! empty( $atts['font_size'] ) ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['font_size'] ) . 'px';
				}
			}

			if ( ! empty( $atts['font_weight'] ) ) {
				$styles[] = 'font-weight: ' . $atts['font_weight'];
			}

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			if ( '' !== $atts['margin'] ) {
				$styles[] = 'margin: ' . $atts['margin'];
			}

			if ( '' !== $atts['padding'] ) {
				$styles[] = 'padding: ' . $atts['padding'];
			}

			return $styles;
		}

		private function get_corner_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['corner_color'] ) && 'outlined' == $atts['button_layout'] ) {
				$styles[] = 'color: ' . $atts['corner_color'];
			}

			return $styles;
		}
	}
}
