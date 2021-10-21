<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_interactive_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_interactive_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'EmaurriCore_Portfolio_Interactive_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'emaurri_core_filter_register_shortcodes', 'emaurri_core_add_portfolio_interactive_list_shortcode' );
}

if ( class_exists( 'EmaurriCore_List_Shortcode' ) ) {
	class EmaurriCore_Portfolio_Interactive_List_Shortcode extends EmaurriCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EMAURRI_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-interactive-list' );
			$this->set_base( 'emaurri_core_portfolio_interactive_list' );
			$this->set_name( esc_html__( 'Interactive Portfolio List', 'emaurri-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays scrollable list of portfolios', 'emaurri-core' ) );
			$this->set_category( esc_html__( 'Emaurri Core', 'emaurri-core' ) );
//			$this->set_scripts( apply_filters( 'emaurri_core_filter_portfolio_list_register_assets', array() ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'emaurri-core' ),
				)
			);
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'emaurri_core_portfolio_interactive_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

//		public function load_assets() {
//			parent::load_assets();
//
////			do_action( 'emaurri_core_action_portfolio_list_load_assets', $this->get_atts() );
//		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_taxonomy();

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['query_result']   = new \WP_Query( emaurri_core_get_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			$atts['this_shortcode'] = $this;

			return emaurri_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-interactive-list', 'templates/content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-interactive-list';

			return $holder_classes;
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_item_link() {
			$portfolio_link_meta = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
			$portfolio_link      = ! empty( $portfolio_link_meta ) ? $portfolio_link_meta : get_permalink( get_the_ID() );

			return $portfolio_link;
		}
	}
}
