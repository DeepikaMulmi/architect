<?php

class EmaurriCore_Portfolio_Project_Info_Shortcode_Elementor extends EmaurriCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'emaurri_core_portfolio_project_info' );

		parent::__construct( $data, $args );
	}
}

emaurri_core_get_elementor_widgets_manager()->register_widget_type( new EmaurriCore_Portfolio_Project_Info_Shortcode_Elementor() );
