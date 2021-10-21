<?php

if ( ! function_exists( 'emaurri_core_add_numbered_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function emaurri_core_add_numbered_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'EmaurriCore_Numbered_Text_Shortcode';

		return $shortcodes;
	}

	add_filter( 'emaurri_core_filter_register_shortcodes', 'emaurri_core_add_numbered_text_shortcode' );
}

if ( class_exists( 'EmaurriCore_Shortcode' ) ) {
	class EmaurriCore_Numbered_Text_Shortcode extends EmaurriCore_Shortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( EMAURRI_CORE_SHORTCODES_URL_PATH . '/numbered-text' );
			$this->set_base( 'emaurri_core_numbered_text' );
			$this->set_name( esc_html__( 'Numbered Text', 'emaurri-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds numbered text element', 'emaurri-core' ) );
			$this->set_category( esc_html__( 'Emaurri Core', 'emaurri-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'emaurri-core' ),
				)
			);
            $this->set_option(
            	array(
	                'field_type' => 'text',
	                'name'       => 'number',
	                'title'      => esc_html__( 'Number', 'emaurri-core' )
                )
            );
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'number_color',
					'title'      => esc_html__( 'Number Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Number Style', 'emaurri-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'number_font_size',
					'title'      => esc_html__( 'Number Font Size', 'emaurri-core' ),
					'group'      => esc_html__( 'Number Style', 'emaurri-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title',
					'title'      => esc_html__( 'Title', 'emaurri-core' )
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'emaurri-core' ),
					'options'       => emaurri_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'h5',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'title_color',
					'title'      => esc_html__( 'Title Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Title Style', 'emaurri-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title_margin_top',
					'title'      => esc_html__( 'Title Margin Top', 'emaurri-core' ),
					'group'      => esc_html__( 'Title Style', 'emaurri-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'text',
					'title'      => esc_html__( 'Text', 'emaurri-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'text_color',
					'title'      => esc_html__( 'Text Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Text Style', 'emaurri-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'text_font_size',
					'title'      => esc_html__( 'Text Font Size', 'emaurri-core' ),
					'group'      => esc_html__( 'Text Style', 'emaurri-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'text_margin_top',
					'title'      => esc_html__( 'Text Margin Top', 'emaurri-core' ),
					'group'      => esc_html__( 'Text Style', 'emaurri-core' )
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'enable_button',
					'title'         => esc_html__( 'Enable Button', 'emaurri-core' ),
					'options'       => emaurri_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'yes'
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'button_text',
					'title'         => esc_html__( 'Button Text', 'emaurri-core' ),
					'dependency'    => array(
						'show' => array(
							'enable_button' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							)
						)
					)
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'button_link',
					'title'      => esc_html__( 'Button Link', 'emaurri-core' ),
					'dependency' => array(
						'show' => array(
							'enable_button' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							)
						)
					)
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'button_link_target',
					'title'         => esc_html__( 'Button Link Target', 'emaurri-core' ),
					'options'       => emaurri_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_blank',
					'dependency'    => array(
						'show' => array(
							'enable_button' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							)
						)
					)
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'button_margin_top',
					'title'      => esc_html__( 'Button Margin Top', 'emaurri-core' ),
					'group'      => esc_html__( 'Button Style', 'emaurri-core' ),
					'dependency' => array(
						'show' => array(
							'enable_button' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							)
						)
					)
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'button_color',
					'title'      => esc_html__( 'Button Color', 'emaurri-core' ),
					'group'      => esc_html__( 'Button Style', 'emaurri-core' )
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'button_font_size',
					'title'      => esc_html__( 'Button Font Size', 'emaurri-core' ),
					'group'      => esc_html__( 'Button Style', 'emaurri-core' )
				)
			);
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes();
			$atts['number_styles']  = $this->get_number_styles( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['button_styles']  = $this->get_button_styles( $atts );
			
			return emaurri_core_get_template_part( 'shortcodes/numbered-text', 'templates/numbered-text', '', $atts );
		}
		
		private function get_holder_classes() {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-numbered-text';
			
			return implode( ' ', $holder_classes );
		}

		private function get_number_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['number_color'] ) ) {
				$styles[] = '-webkit-text-stroke-color: ' . $atts['number_color'];
			}

			if ( '' !== $atts['number_font_size'] ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['number_font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['number_font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['number_font_size'] ) . 'px';
				}
			}

			return $styles;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			if ( $atts['title_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}

			return $styles;
		}
		
		private function get_text_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}

			if ( '' !== $atts['text_font_size'] ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['text_font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['text_font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['text_font_size'] ) . 'px';
				}
			}

			if ( $atts['text_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
				}
			}
			
			return $styles;
		}

		private function get_button_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['button_color'] ) ) {
				$styles[] = 'color: ' . $atts['button_color'];
			}

			if ( '' !== $atts['button_font_size'] ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['button_font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['button_font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['button_font_size'] ) . 'px';
				}
			}

			if ( $atts['button_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['button_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['button_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['button_margin_top'] ) . 'px';
				}
			}

			return $styles;
		}
	}
}