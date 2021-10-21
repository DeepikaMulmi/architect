<?php

class EmaurriCore_Standard_Title extends EmaurriCore_Title {
	private static $instance;

	public function __construct() {
		$this->slug       = 'standard';
		$this->parameters = $this->get_parameters();

		// Add title area inline styles
		add_filter( 'emaurri_filter_add_inline_style', array( $this, 'add_inline_styles' ) );
	}

	/**
	 * @return EmaurriCore_Standard_Title
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function add_inline_styles( $style ) {
		$styles = array();

		$color      = emaurri_core_get_post_value_through_levels( 'qodef_page_title_subtitle_color' );
		$top_margin = emaurri_core_get_post_value_through_levels( 'qodef_page_title_subtitle_top_margin' );

		if ( ! empty( $color ) ) {
			$styles['color'] = $color;
		}

		if ( '' !== $top_margin ) {
			$styles['margin-top'] = intval( $top_margin ) . 'px';
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-page-title.qodef-title--standard .qodef-m-subtitle', $styles );
		}

		return $style;
	}

	function get_parameters() {
		$parameters = array();

		$parameters = array_merge( $parameters, array( 'title_tag' => emaurri_core_get_post_value_through_levels( 'qodef_page_title_tag' ) ) );

		return $parameters;
	}
}
