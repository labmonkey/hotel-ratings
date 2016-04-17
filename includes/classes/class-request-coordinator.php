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
	private $controllers, $request;

	function __construct( $request ) {
		$this->init_controller_map();

		$this->request = $request;
	}

	function init_controller_map() {
		$this->controllers = array(
			"/"        => "HomepageController",
			"/admin"   => "AdminController",
			"/account" => "AccountController"
		);
	}

	function get_controller( $path = '' ) {
		if ( empty( $path ) ) {
			$path = $this->request;
		}

		$path = strtok( $path, '?' );
		if ( strlen( $path ) > 1 ) {
			$path = rtrim( $path, '/\\' );
		}

		if ( array_key_exists( $path, $this->controllers ) ) {
			if ( ( strpos( $path, '/admin' ) === 0 &&
			       ! empty( session()->get_current_user() ) &&
			       session()->get_current_user()->getAdmin() == false )
			     ||
			     ( strpos( $path, '/account' ) === 0 &&
			       empty( session()->get_current_user() ) )
			) {
				$controller = new ErrorController( app()->getView(), '403' );
			} else {
				$class      = $this->controllers[ $path ];
				$controller = new $class( app()->getView() );
			}
		} else {
			$controller = new ErrorController( app()->getView(), '404' );
		}

		return $controller;
	}

	function is_admin() {
		return strpos( $this->request, '/admin' ) === 0;
	}

	function is_account() {
		return strpos( $this->request, '/account' ) === 0;
	}
}