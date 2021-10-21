<?php

class QiAddonsForElementor_Team_Member_Shortcode_Elementor extends QiAddonsForElementor_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'qi_addons_for_elementor_team_member' );

		parent::__construct( $data, $args );
	}
}

qi_addons_for_elementor_get_elementor_widgets_manager()->register_widget_type( new QiAddonsForElementor_Team_Member_Shortcode_Elementor() );
