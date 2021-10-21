<?php

if ( ! function_exists( 'emaurri_core_add_vertical_split_slider_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function emaurri_core_add_vertical_split_slider_shortcode( $shortcodes ) {
		$shortcodes[] = 'EmaurriCore_Vertical_Split_Slider_Shortcode';

		return $shortcodes;
	}

	add_filter( 'emaurri_core_filter_register_shortcodes', 'emaurri_core_add_vertical_split_slider_shortcode' );
}

if ( class_exists( 'EmaurriCore_Shortcode' ) ) {
	class EmaurriCore_Vertical_Split_Slider_Shortcode extends EmaurriCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( EMAURRI_CORE_SHORTCODES_URL_PATH . '/vertical-split-slider' );
			$this->set_base( 'emaurri_vertical_split_slider' );
			$this->set_name( esc_html__( 'Vertical Split Slider', 'emaurri-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds vertical split slider holder', 'emaurri-core' ) );
			$this->set_category( esc_html__( 'Emaurri Core', 'emaurri-core' ) );
			$this->set_scripts(
				array(
					'jquery-effects-core' => array(
						'registered' => true,
					),
					'multiscroll'         => array(
						'registered' => false,
						'url'        => EMAURRI_CORE_SHORTCODES_URL_PATH . '/vertical-split-slider/assets/js/plugins/jquery.multiscroll.min.js',
						'dependency' => array( 'jquery', 'jquery-effects-core' ),
					),
				)
			);

			$this->set_necessary_styles(
				array(
					'multiscroll' => array(
						'registered' => false,
						'url'        => EMAURRI_CORE_SHORTCODES_URL_PATH . '/vertical-split-slider/assets/css/plugins/jquery.multiscroll.css',
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'disable_breakpoint',
					'title'         => esc_html__( 'Disable on smaller screens', 'emaurri-core' ),
					'options'       => array(
						'1024' => esc_html__( 'Below 1024px', 'emaurri-core' ),
						'768'  => esc_html__( 'Below 768px', 'emaurri-core' ),
					),
					'default_value' => '1024',
				)
			);

			$slide_items_array_templates = array();
			if ( qode_framework_is_installed( 'elementor' ) ) {
				$elementor_sections = emaurri_core_generate_elementor_templates_control( $this );

				if ( ! empty( $elementor_sections ) ) {
					$slide_items_array_templates[] = $elementor_sections;
				}
			}

			$slide_items_array = array(
				array(
					'field_type' => 'select',
					'name'       => 'slide_header_style',
					'title'      => esc_html__( 'Header/Bullets Style', 'emaurri-core' ),
					'options'    => array(
						''      => esc_html__( 'Default', 'emaurri-core' ),
						'light' => esc_html__( 'Light', 'emaurri-core' ),
						'dark'  => esc_html__( 'Dark', 'emaurri-core' ),
					),
				),
				array(
					'field_type' => 'select',
					'name'       => 'slide_layout',
					'title'      => esc_html__( 'Slide Layout', 'emaurri-core' ),
					'options'    => array(
						'image-left'  => esc_html__( 'Image On Left', 'emaurri-core' ),
						'image-right' => esc_html__( 'Image On Right', 'emaurri-core' ),
					),
				),
				array(
					'field_type' => 'image',
					'name'       => 'slide_image',
					'title'      => esc_html__( 'Image', 'emaurri-core' ),
				),
				array(
					'field_type' => 'text',
					'name'       => 'slide_content_title',
					'title'      => esc_html__( 'Title', 'emaurri-core' ),
					'dependency'     => array(
						'show' => array(
							'predefined_section' => array(
								'values'        => '0',
								'default_value' => '',
							),
						),
					),
				),
				array(
					'field_type'    => 'select',
					'name'          => 'slide_content_title_tag',
					'title'         => esc_html__( 'Title Tag', 'emaurri-core' ),
					'options'       => emaurri_core_get_select_type_options_pool( 'title_tag', false ),
					'default_value' => 'h2',
					'dependency'     => array(
						'show' => array(
							'predefined_section' => array(
								'values'        => '0',
								'default_value' => '',
							),
						),
					),
				),
				array(
					'field_type' => 'text',
					'name'       => 'slide_content_subtitle',
					'title'      => esc_html__( 'Subtitle', 'emaurri-core' ),
					'dependency'     => array(
						'show' => array(
							'predefined_section' => array(
								'values'        => '0',
								'default_value' => '',
							),
						),
					),
				),
				array(
					'field_type' => 'textarea',
					'name'       => 'slide_content_text',
					'title'      => esc_html__( 'Text', 'emaurri-core' ),
					'dependency'     => array(
						'show' => array(
							'predefined_section' => array(
								'values'        => '0',
								'default_value' => '',
							),
						),
					),
				),
				array(
					'field_type' => 'color',
					'name'       => 'slide_content_bgcolor',
					'title'      => esc_html__( 'Content Background Color', 'emaurri-core' ),
				),
				array(
					'field_type' => 'image',
					'name'       => 'slide_content_image',
					'title'      => esc_html__( 'Content Image', 'emaurri-core' ),
					'dependency'     => array(
						'show' => array(
							'predefined_section' => array(
								'values'        => '0',
								'default_value' => '',
							),
						),
					),
				),
				array(
					'field_type' => 'text',
					'name'       => 'slide_content_button_link',
					'title'      => esc_html__( 'Button Link', 'emaurri-core' ),
					'dependency'     => array(
						'show' => array(
							'predefined_section' => array(
								'values'        => '0',
								'default_value' => '',
							),
						),
					),
				),
				array(
					'field_type' => 'text',
					'name'       => 'slide_content_button_text',
					'title'      => esc_html__( 'Button Text', 'emaurri-core' ),
					'dependency'     => array(
						'show' => array(
							'predefined_section' => array(
								'values'        => '0',
								'default_value' => '',
							),
						),
					),
				),
				array(
					'field_type' => 'select',
					'name'       => 'slide_content_button_target',
					'title'      => esc_html__( 'Button Target', 'emaurri-core' ),
					'options'    => emaurri_core_get_select_type_options_pool( 'link_target', false ),
					'dependency'     => array(
						'show' => array(
							'predefined_section' => array(
								'values'        => '0',
								'default_value' => '',
							),
						),
					),
				),
			);

			$slide_items_array = array_merge( $slide_items_array_templates, $slide_items_array );

			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Slide Items', 'emaurri-core' ),
					'items'      => $slide_items_array,
				)
			);
		}

		public function load_assets() {
			wp_enqueue_script( 'jquery-effects-core' );

			wp_enqueue_script( 'multiscroll' );
			wp_enqueue_style( 'multiscroll' );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts                   = $this->get_atts();
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['this_object']    = $this;
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );

			return emaurri_core_get_template_part( 'shortcodes/vertical-split-slider', 'templates/vertical-split-slider', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-vertical-split-slider qodef-m';
			$holder_classes[] = ! empty( $atts['disable_breakpoint'] ) ? 'qodef-disable-below--' . $atts['disable_breakpoint'] : '';

			return implode( ' ', $holder_classes );
		}

		public function get_slide_image_styles( $slide_atts ) {
			$styles = array();

			$styles[] = ! empty( $slide_atts['slide_image'] ) ? 'background-image: url(' . wp_get_attachment_url( $slide_atts['slide_image'] ) . ')' : '';

			return $styles;
		}

		public function get_slide_content_styles( $slide_atts ) {
			$styles = array();

			$styles[] = ! empty( $slide_atts['slide_content_bgcolor'] ) ? 'background-color: ' . $slide_atts['slide_content_bgcolor'] : '';

			return $styles;
		}

		public function get_slide_data( $slide_atts ) {
			$data = array();

			$data['data-header-skin'] = ! empty( $slide_atts['slide_header_style'] ) ? $slide_atts['slide_header_style'] : '';

			return $data;
		}
	}
}
