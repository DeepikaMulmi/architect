<?php

class EmaurriCore_Side_Area_Mobile_Header extends EmaurriCore_Mobile_Header {
	private static $instance;

	public function __construct() {
		$this->set_layout( 'side-area' );
		$this->default_header_height = 70;

		parent::__construct();
	}

	/**
	 * @return EmaurriCore_Side_Area_Mobile_Header
	 */
	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

    public function enqueue_additional_assets() {
    }
}
