<?php

class EmaurriCore_Elementor_Section_Handler {
	private static $instance;
	public $sections = array();

	public function __construct() {
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( $this, 'render_parallax_options' ), 10, 2 );
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( $this, 'render_offset_options' ), 10, 2 );
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( $this, 'render_grid_options' ), 10, 2 );
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( $this, 'render_background_text_options' ), 10, 2 );
		add_action( 'elementor/frontend/section/before_render', array( $this, 'section_before_render' ) );
		add_action( 'elementor/frontend/before_enqueue_styles', array( $this, 'enqueue_styles' ), 9 );
		add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ), 9 );
	}

	/**
	 * @return EmaurriCore_Elementor_Section_Handler
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function render_parallax_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_parallax',
			[
				'label' => esc_html__( 'Emaurri Parallax', 'emaurri-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_parallax_type',
			[
				'label'       => esc_html__( 'Enable Parallax', 'emaurri-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => [
					'no'       => esc_html__( 'No', 'emaurri-core' ),
					'parallax' => esc_html__( 'Yes', 'emaurri-core' ),
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_parallax_image',
			[
				'label'       => esc_html__( 'Parallax Background Image', 'emaurri-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'condition'   => [
					'qodef_parallax_type' => 'parallax',
				],
				'render_type' => 'template',
			]
		);

		$section->end_controls_section();
	}

	public function render_offset_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_offset',
			[
				'label' => esc_html__( 'Emaurri Offset Image', 'emaurri-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_offset_type',
			[
				'label'       => esc_html__( 'Enable Offset Image', 'emaurri-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => [
					'no'     => esc_html__( 'No', 'emaurri-core' ),
					'offset' => esc_html__( 'Yes', 'emaurri-core' ),
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_offset_image',
			[
				'label'       => esc_html__( 'Offset Image', 'emaurri-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'condition'   => [
					'qodef_offset_type' => 'offset',
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_offset_top',
			[
				'label'       => esc_html__( 'Offset Image Top Position', 'emaurri-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '50%',
				'condition'   => [
					'qodef_offset_type' => 'offset',
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_offset_left',
			[
				'label'       => esc_html__( 'Offset Image Left Position', 'emaurri-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '50%',
				'condition'   => [
					'qodef_offset_type' => 'offset',
				],
				'render_type' => 'template',
			]
		);

		$section->end_controls_section();
	}

	public function render_grid_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_grid_row',
			[
				'label' => esc_html__( 'Emaurri Grid', 'emaurri-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_enable_grid_row',
			[
				'label'        => esc_html__( 'Make this row "In Grid"', 'emaurri-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'   => esc_html__( 'No', 'emaurri-core' ),
					'grid' => esc_html__( 'Yes', 'emaurri-core' ),
				],
				'prefix_class' => 'qodef-elementor-content-',
			]
		);

		$section->add_control(
			'qodef_grid_row_behavior',
			[
				'label'        => esc_html__( 'Grid Row Behavior', 'emaurri-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => [
					''      => esc_html__( 'Default', 'emaurri-core' ),
					'right' => esc_html__( 'Extend Grid Right', 'emaurri-core' ),
					'left'  => esc_html__( 'Extend Grid Left', 'emaurri-core' ),
				],
				'condition'    => [
					'qodef_enable_grid_row' => 'grid',
				],
				'prefix_class' => 'qodef-extended-grid qodef-extended-grid--',
			]
		);

		$section->end_controls_section();
	}

	public function render_background_text_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_background_text_row',
			[
				'label' => esc_html__( 'Emaurri Row Background Text', 'emaurri-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_row_background_text',
			[
				'label'        => esc_html__( 'Background Text', 'emaurri-core' ),
				'type'         => \Elementor\Controls_Manager::TEXT,
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_row_background_text_margin',
			[
				'label'        => esc_html__( 'Background Text Margin', 'emaurri-core' ),
				'type'         => \Elementor\Controls_Manager::TEXT,
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_row_background_text_margin_laptop',
			[
				'label'        => esc_html__( 'Laptop Margin', 'emaurri-core' ),
				'type'         => \Elementor\Controls_Manager::TEXT,
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_row_background_text_font_size',
			[
				'label'        => esc_html__( 'Background Text Font Size', 'emaurri-core' ),
				'type'         => \Elementor\Controls_Manager::TEXT,
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_row_background_text_color',
			[
				'label'        => esc_html__( 'Background Text Color', 'emaurri-core' ),
				'type'         => \Elementor\Controls_Manager::COLOR,
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_row_background_text_z_index',
			[
				'label'        => esc_html__( 'Background Text Z-Index', 'emaurri-core' ),
				'type'         => \Elementor\Controls_Manager::TEXT,
				'render_type' => 'template',
			]
		);

		$section->end_controls_section();
	}

	public function section_before_render( $widget ) {
		$data     = $widget->get_data();
		$type     = isset( $data['elType'] ) ? $data['elType'] : 'section';
		$settings = $data['settings'];

		if ( 'section' === $type ) {
			if ( isset( $settings['qodef_parallax_type'] ) && 'parallax' === $settings['qodef_parallax_type'] ) {
				$parallax_type  = $widget->get_settings_for_display( 'qodef_parallax_type' );
				$parallax_image = $widget->get_settings_for_display( 'qodef_parallax_image' );

				if ( ! in_array( $data['id'], $this->sections, true ) ) {
					$this->sections[ $data['id'] ][] = array(
						'parallax_type'  => $parallax_type,
						'parallax_image' => $parallax_image,
					);
				}
			}

			if ( isset( $settings['qodef_offset_type'] ) && 'offset' === $settings['qodef_offset_type'] ) {
				$offset_type  = $widget->get_settings_for_display( 'qodef_offset_type' );
				$offset_image = $widget->get_settings_for_display( 'qodef_offset_image' );
				$offset_top   = $widget->get_settings_for_display( 'qodef_offset_top' );
				$offset_left  = $widget->get_settings_for_display( 'qodef_offset_left' );

				if ( ! in_array( $data['id'], $this->sections, true ) ) {
					$this->sections[ $data['id'] ][] = array(
						'offset_type'  => $offset_type,
						'offset_image' => $offset_image,
						'offset_top'   => $offset_top,
						'offset_left'  => $offset_left,
					);
				}
			}

			if ( isset( $settings['qodef_row_background_text'] ) && '' !== $settings['qodef_row_background_text'] ) {
				$text           = $widget->get_settings_for_display( 'qodef_row_background_text' );
				$margin         = $widget->get_settings_for_display( 'qodef_row_background_text_margin' );
				$margin_laptop  = $widget->get_settings_for_display( 'qodef_row_background_text_margin_laptop' );
				$font_size      = $widget->get_settings_for_display( 'qodef_row_background_text_font_size' );
				$color          = $widget->get_settings_for_display( 'qodef_row_background_text_color' );
				$z_index        = $widget->get_settings_for_display( 'qodef_row_background_text_z_index' );

				if ( ! in_array( $data['id'], $this->sections, true ) ) {
					$this->sections[ $data['id'] ][] = array(
						'bg_text' => $text,
						'bg_margin' => $margin,
						'bg_margin_laptop' => $margin_laptop,
						'bg_font_size'   => $font_size,
						'bg_color'  => $color,
						'bg_z_index'  => $z_index,
					);
				}
			}
		}
	}

	public function enqueue_styles() {
		wp_enqueue_style( 'emaurri-core-elementor', EMAURRI_CORE_PLUGINS_URL_PATH . '/elementor/assets/css/elementor.min.css' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'emaurri-core-elementor', EMAURRI_CORE_PLUGINS_URL_PATH . '/elementor/assets/js/elementor.js', array( 'jquery', 'elementor-frontend' ) );

		$elementor_global_vars = array(
			'elementorSectionHandler' => $this->sections,
		);

		wp_localize_script(
			'emaurri-core-elementor',
			'qodefElementorGlobal',
			array(
				'vars' => $elementor_global_vars,
			)
		);
	}
}

if ( ! function_exists( 'emaurri_core_init_elementor_section_handler' ) ) {
	/**
	 * Function that initialize main page builder handler
	 */
	function emaurri_core_init_elementor_section_handler() {
		EmaurriCore_Elementor_Section_Handler::get_instance();
	}

	add_action( 'init', 'emaurri_core_init_elementor_section_handler', 1 );
}
