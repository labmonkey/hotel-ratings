<?php

/**
 * Author: Paweł Derehajło
 * Company: Airnauts
 * Contact: pawel@airnauts.com, derehajlo@gmail.com
 * Date: 13/04/16
 *
 * Summary:
 * TODO summary of this file
 */
class RequestCoordinator {
	private $controllers;

	function __construct() {
		$this->init_controller_map();
	}

	function init_controller_map() {
		$this->controllers = array(
			"/"      => "HomepageController",
			"/admin" => "AdminController"
		);
	}

	function get_controller( $path ) {
		if ( array_key_exists( $path, $this->controllers ) ) {
			$class = $this->controllers[ $path ];

			$controller = new $class( app()->getView() );
		} else {
			$controller = new ErrorController( app()->getView(), '404' );
		}

		return $controller;
	}

	function handle_request( $path ) {

	}
}