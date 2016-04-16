<?php

/**
 * Author: Paweł Derehajło
 * Company: Airnauts
 * Contact: pawel@airnauts.com, derehajlo@gmail.com
 * Date: 16/04/16
 *
 * Summary:
 * TODO summary of this file
 */
class SessionManager {
	private $user;

	function __construct() {
		$this->start();
		$this->user = $this->get_current_user();
	}

	function is_user_logged_in() {
		return ! empty( $this->get_current_user() );
	}

	function get_current_user() {
		if ( ! empty( $this->user ) ) {
			return $this->user;
		}
		if ( isset( $_SESSION['user'] ) ) {
			$this->user = $_SESSION['user'];
			return $this->user;
		}

		return false;
	}

	function set_current_user( $user ) {
		$this->user = $user;
		$this->set( 'user', $user );
	}

	function start() {
		if ( session_status() == PHP_SESSION_NONE ) {
			session_start();
		}
	}

	function stop() {
		$_SESSION = array();
		session_destroy();
		$this->user = null;
	}

	function set( $key, $value ) {
		$_SESSION[ $key ] = $value;
	}

	function get( $key ) {

	}
}
