<?php

if ( ! function_exists( 'emaurri_core_add_countdown_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function emaurri_core_add_countdown_shortcode( $shortcodes ) {
		$shortcodes[] = 'EmaurriCore_Countdown_Shortcode';

		return $shortcodes;
	}

	add_filter( 'emaurri_core_filter_register_shortcodes', 'emaurri_core_add_countdown_shortcode' );
}

if ( class_exists( 'EmaurriCore_Shortcode' ) ) {
	class EmaurriCore_Countdown_Shortcode extends EmaurriCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'emaurri_core_filter_countdown_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( EMAURRI_CORE_SHORTCODES_URL_PATH . '/countdown' );
			$this->set_base( 'emaurri_core_countdown' );
			$this->set_name( esc_html__( 'Countdown', 'emaurri-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays countdown with provided parameters', 'emaurri-core' ) );
			$this->set_category( esc_html__( 'Emaurri Core', 'emaurri-core' ) );
			$this->set_scripts(
				array(
					'countdown' => array(
						'registered' => false,
						'url'        => EMAURRI_CORE_INC_URL_PATH . '/shortcodes/countdown/assets/js/plugins/jquery.countdown.min.js',
						'dependency' => array( 'jquery' ),
					),
				)
			);

			$options_map = emaurri_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'layout',
					'title'         => esc_html__( 'Layout', 'emaurri-core' ),
					'options'       => $this->get_layouts(),
					'default_value' => $options_map['default_value'],
					'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] ),
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
					'field_type'  => 'date',
					'name'        => 'date',
					'title'       => esc_html__( 'Date', 'emaurri-core' ),
					'description' => esc_html__( 'Format: YYYY/mm/dd', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'date_hour',
					'title'      => esc_html__( 'Hour', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'date_minute',
					'title'      => esc_html__( 'Minute', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'week_label',
					'title'      => esc_html__( 'Week Label', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'week_label_plural',
					'title'      => esc_html__( 'Week Label Plural', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'day_label',
					'title'      => esc_html__( 'Day Label', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'day_label_plural',
					'title'      => esc_html__( 'Day Label Plural', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'hour_label',
					'title'      => esc_html__( 'Hour Label', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'hour_label_plural',
					'title'      => esc_html__( 'Hour Label Plural', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'minute_label',
					'title'      => esc_html__( 'Minute Label', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'minute_label_plural',
					'title'      => esc_html__( 'Minute Label Plural', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'second_label',
					'title'      => esc_html__( 'Second Label', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'second_label_plural',
					'title'      => esc_html__( 'Second Label Plural', 'emaurri-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'skin',
					'title'      => esc_html__( 'Skin', 'emaurri-core' ),
					'options'    => array(
						''      => esc_html__( 'Default', 'emaurri-core' ),
						'light' => esc_html__( 'Light', 'emaurri-core' ),
					),
				)
			);
		}

		public function load_assets() {
			wp_enqueue_script( 'countdown' );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['data_attrs']     = $this->get_data_attrs( $atts );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			return emaurri_core_get_template_part( 'shortcodes/countdown', 'variations/' . $atts['layout'] . '/templates/countdown', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-countdown';
			$holder_classes[] = 'qodef-show--5';

			$holder_classes[] = ! empty( $atts['skin'] ) ? 'qodef-countdown--' . $atts['skin'] : '';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $holder_classes );
		}

		private function get_data_attrs( $atts ) {
			$data = array();

			if ( ! empty( $atts['date'] ) ) {
				$date              = $atts['date'];
				$date_formatted    = gmdate( 'Y/m/d', strtotime( $date ) );
				$hour              = ! empty( $atts['date_hour'] ) ? $atts['date_hour'] : '00';
				$minute            = ! empty( $atts['date_minute'] ) ? $atts['date_minute'] : '00';
				$date              = $date_formatted . ' ' . $hour . ':' . $minute . ':00';
				$data['data-date'] = $date;
			}

			$date_formats = array(
				'week'   => array(
					'default' => esc_html__( 'Week', 'emaurri-core' ),
					'plural'  => esc_html__( 'Weeks', 'emaurri-core' ),
				),
				'day'    => array(
					'default' => esc_html__( 'Day', 'emaurri-core' ),
					'plural'  => esc_html__( 'Days', 'emaurri-core' ),
				),
				'hour'   => array(
					'default' => esc_html__( 'Hour', 'emaurri-core' ),
					'plural'  => esc_html__( 'Hours', 'emaurri-core' ),
				),
				'minute' => array(
					'default' => esc_html__( 'Minute', 'emaurri-core' ),
					'plural'  => esc_html__( 'Minutes', 'emaurri-core' ),
				),
				'second' => array(
					'default' => esc_html__( 'Second', 'emaurri-core' ),
					'plural'  => esc_html__( 'Seconds', 'emaurri-core' ),
				),
			);

			foreach ( $date_formats as $key => $value ) {
				if ( ! empty( $atts[ $key . '_label' ] ) ) {
					$data[ 'data-' . $key . '-label' ] = $atts[ $key . '_label' ];
				} else {
					$data[ 'data-' . $key . '-label' ] = $value['default'];
				}

				if ( ! empty( $atts[ $key . '_label_plural' ] ) ) {
					$data[ 'data-' . $key . '-label-plural' ] = $atts[ $key . '_label_plural' ];
				} else {
					$data[ 'data-' . $key . '-label-plural' ] = $value['plural'];
				}
			}

			return $data;
		}
	}
}
