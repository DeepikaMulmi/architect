<?php

class QiAddonsForElementor_Image_Gallery_Pinterest_Shortcode_Elementor extends QiAddonsForElementor_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'qi_addons_for_elementor_image_gallery_pinterest' );

		parent::__construct( $data, $args );
	}
}

qi_addons_for_elementor_get_elementor_widgets_manager()->register_widget_type( new QiAddonsForElementor_Image_Gallery_Pinterest_Shortcode_Elementor() );
