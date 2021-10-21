<?php

if ( ! function_exists( 'emaurri_core_add_triple_image_highlight_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function emaurri_core_add_triple_image_highlight_shortcode( $shortcodes ) {
		$shortcodes[] = 'EmaurriCore_Triple_Image_Highlight_Shortcode';

		return $shortcodes;
	}

	add_filter( 'emaurri_core_filter_register_shortcodes', 'emaurri_core_add_triple_image_highlight_shortcode' );
}

if ( class_exists( 'EmaurriCore_Shortcode' ) ) {
	class EmaurriCore_Triple_Image_Highlight_Shortcode extends EmaurriCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'emaurri_core_filter_triple_image_highlight_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'emaurri_core_filter_triple_image_highlight_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EMAURRI_CORE_SHORTCODES_URL_PATH . '/triple-image-highlight' );
			$this->set_base( 'emaurri_core_triple_image_highlight' );
			$this->set_name( esc_html__( 'Triple Image Highlight', 'emaurri-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds triple image highlight element', 'emaurri-core' ) );
			$this->set_category( esc_html__( 'CleverSoft Core', 'emaurri-core' ) );
			$this->set_option ( array (
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'emaurri-core' ),
			) );

			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'center_image',
				'title'      => esc_html__( 'Center Image', 'emaurri-core' ),
			));
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'center_link',
				'title'      => esc_html__( 'Center Image Link', 'emaurri-core' ),
			) );

			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'left_image',
				'title'      => esc_html__( 'Left Image', 'emaurri-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'left_link',
				'title'      => esc_html__( 'Left Image Link', 'emaurri-core' ),
			) );

			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'right_image',
				'title'      => esc_html__( 'Right Image', 'emaurri-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'right_link',
				'title'      => esc_html__( 'Right Image Link', 'emaurri-core' ),
			) );

			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Link Target', 'emaurri-core' ),
				'options'       => emaurri_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_blank',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'navigation_enabled',
				'title'         => esc_html__( 'Enable Navigation', 'emaurri-core' ),
				'options'       => emaurri_core_get_select_type_options_pool( 'yes_no' ),
				'default_value' => '_blank',
			) );
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'emaurri_core_triple_image_highlight', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['image_params']   = $this->generate_image_params( $atts );

			return emaurri_core_get_template_part( 'shortcodes/triple-image-highlight', '/templates/triple-image-highlight', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-triple-image-highlight';

			$holder_classes[] = ! empty( $atts['navigation_enabled'] ) && 'no' !== ( $atts['navigation_enabled'] ) ? 'qodef-navigation-enabled' : '';

			return implode( ' ', $holder_classes );
		}

		private function generate_image_params( $atts ) {
			$image = array();

			if ( ! empty( $atts['image'] ) ) {
				$id = $atts['image'];

				$image['image_id'] = intval( $id );
				$image_original    = wp_get_attachment_image_src( $id, 'full' );
				$image['url']      = $image_original[0];
				$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );

				$image_size = trim( $atts['image_size'] );
				preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
				if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
					$image['image_size'] = $image_size;
				} elseif ( ! empty( $matches[0] ) ) {
					$image['image_size'] = array(
						$matches[0][0],
						$matches[0][1],
					);
				} else {
					$image['image_size'] = 'full';
				}
			}

			return $image;
		}
		private function get_button_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['button_color'] ) ) {
				$styles[] = 'color: ' . $atts['button_color'];
			}

			return $styles;
		}
	}
}