<?php

class EmaurriCore_Image_With_Text_Shortcode_Elementor extends EmaurriCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'emaurri_core_image_with_text' );

		parent::__construct( $data, $args );
	}
}

emaurri_core_get_elementor_widgets_manager()->register_widget_type( new EmaurriCore_Image_With_Text_Shortcode_Elementor() );
