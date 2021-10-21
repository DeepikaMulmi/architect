<?php

if ( ! function_exists( 'emaurri_core_add_portfolio_project_info_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function emaurri_core_add_portfolio_project_info_shortcode( $shortcodes ) {
		$shortcodes[] = 'EmaurriCore_Portfolio_Project_Info_Shortcode';

		return $shortcodes;
	}

	add_filter( 'emaurri_core_filter_register_shortcodes', 'emaurri_core_add_portfolio_project_info_shortcode' );
}

if ( class_exists( 'EmaurriCore_Shortcode' ) ) {
	class EmaurriCore_Portfolio_Project_Info_Shortcode extends EmaurriCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'emaurri_core_filter_portfolio_project_info_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EMAURRI_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-project-info' );
			$this->set_base( 'emaurri_core_portfolio_project_info' );
			$this->set_name( esc_html__( 'Portfolio Project Info', 'emaurri-core' ) );
			$this->set_description( esc_html__( 'Shortcode that display list of category items', 'emaurri-core' ) );
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
					'name'       => 'portfolio_id',
					'title'      => esc_html__( 'Portfolio Item ID', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'project_info_type',
					'title'      => esc_html__( 'Project Info Type', 'emaurri-core' ),
					'options'       => array(
						'title'         => esc_html__( 'Title', 'emaurri-core' ),
						'category'      => esc_html__( 'Category', 'emaurri-core' ),
						'tag'           => esc_html__( 'Tag', 'emaurri-core' ),
						'author'        => esc_html__( 'Author', 'emaurri-core' ),
						'date'          => esc_html__( 'Date', 'emaurri-core' ),
						'image'         => esc_html__( 'Featured Image', 'emaurri-core' )
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'  => 'project_info_title',
					'title'     => esc_html__( 'Project Info Label', 'emaurri-core' ),
					'description' => esc_html__( 'Add project info label before project info element/s', 'emaurri-core' )
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['project_id'] = ! empty ( $atts[ 'portfolio_id' ] ) ? $atts[ 'portfolio_id' ] : get_the_ID();
			$atts['this_shortcode'] = $this;

			return emaurri_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-project-info', 'templates/content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-project-info';

			return implode( ' ', $holder_classes );
		}
	}
}