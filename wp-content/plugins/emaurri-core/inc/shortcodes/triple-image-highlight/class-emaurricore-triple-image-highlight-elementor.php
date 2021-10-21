<?php

class EmaurriCore_Elementor_Triple_Image_Highlight extends EmaurriCore_Elementor_Widget_Base {
	
	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'emaurri_core_triple_image_highlight' );
		
		parent::__construct( $data, $args );
	}
}

emaurri_core_get_elementor_widgets_manager()->register_widget_type( new EmaurriCore_Elementor_Triple_Image_Highlight() );
