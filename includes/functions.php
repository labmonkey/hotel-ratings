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