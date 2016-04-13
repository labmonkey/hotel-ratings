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

/**
 * @return Application
 */
function app() {
	global $application;
	if ( is_null( $application ) ) {
		$application = new Application();
		$application->init();
	}

	return $application;
}

/*
 * @return Model
 */
function db() {
	return app()->getModel();
}

function is_admin() {
	return app()->is_admin();
}

function get_col( $array, $column, $default = null ) {
	if ( ! empty( $array ) && array_key_exists( $column, $array ) ) {
		return $array[ $column ];
	} else {
		return $default;
	}
}

function password_to_hash( $password ) {
	$cost = 10;

	$salt = strtr( base64_encode( mcrypt_create_iv( 16, MCRYPT_DEV_URANDOM ) ), '+', '.' );

	$salt = sprintf( "$2a$%02d$", $cost ) . $salt;

	$hash = crypt( $password, $salt );

	return $hash;
}

function password_is_valid( $password, $hash ) {
	if ( hash_equals( $hash, crypt( $password, $hash ) ) ) {
		return true;
	}

	return false;
}