<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_exhibition_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_exhibition_shortcode( $shortcodes ) {
		$shortcodes[] = 'EmaurriCore_Portfolio_Exhibition_Shortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'emaurri_core_filter_register_shortcodes', 'emaurri_core_add_portfolio_exhibition_shortcode' );
}

if ( class_exists( 'EmaurriCore_List_Shortcode' ) ) {
	class EmaurriCore_Portfolio_Exhibition_Shortcode extends EmaurriCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EMAURRI_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-exhibition' );
			$this->set_base( 'emaurri_core_portfolio_exhibition' );
			$this->set_name( esc_html__( 'Portfolio Exhibition', 'emaurri-core' ) );
			$this->set_description( esc_html__( 'Shortcode that creates exhibition of portfolios', 'emaurri-core' ) );
			$this->set_category( esc_html__( 'Emaurri Core', 'emaurri-core' ) );
			$this->set_scripts(
				apply_filters('emaurri_core_filter_portfolio_exhibition_register_assets', array())
			);

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'emaurri-core' )
			) );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options( array(
				'layouts'          => $this->get_layouts(),
				'hover_animations' => $this->get_hover_animation_options(),
                'default_value_title_tag' => 'h1'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'background_text',
				'title'      => esc_html__( 'Background text', 'emaurri-core' )
			) );
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'emaurri_core_portfolio_exhibition', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['post_type']       = $this->get_post_type();

			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['query_result']   = new \WP_Query( emaurri_core_get_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			$atts['this_shortcode'] = $this;

			return emaurri_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-exhibition', 'templates/content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-exhibition';

			return implode( ' ', $holder_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			return $styles;
		}
	}
}