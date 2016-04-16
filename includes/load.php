<?php

/**
 * Author: Paweł Derehajło
 * Company: Airnauts
 * Contact: pawel@airnauts.com, derehajlo@gmail.com
 * Date: 12/04/16
 *
 * Summary:
 * TODO summary of this file
 */
class Loader {

	function __construct( $root ) {
		$this->load_vendors();
		$this->load_config( $root );
		$this->load_classes();
		$this->debug_mode();
	}

	function load_vendors() {
		include_once 'vendor/autoload.php';
	}

	function load_config( $root ) {
		include_once 'app-config.php';
		include_once 'classes/static/class-config.php';

		new Config( $root, APP_URL );
	}

	function load_classes() {
		$includes = array(
			'includes/functions.php',
			'includes/classes/abstract/class-controller.php',
			'includes/classes/abstract/class-view.php',
			'includes/classes/abstract/class-model.php',
			'includes/classes/class-application.php',
			'includes/classes/class-twig-view.php',
			'includes/classes/class-request-coordinator.php',
			'includes/classes/class-doctrine-model.php',
			'includes/classes/class-session-manager.php',
			'includes/classes/class-authentication.php'
		);

		$controllers = array(
			'controllers/web/homepage-controller.php',
			'controllers/web/account-controller.php',
			'controllers/error-controller.php',
			'controllers/admin/admin-controller.php',
		);

		$classes = array(
			'includes/test/sample-data.php'
		);

		foreach ( array_merge( $includes, $controllers, $classes ) as $file ) {
			include_once Config::getRootDir( $file );
		}
	}

	function debug_mode() {
		if ( DEBUG ) {
			error_reporting( E_ALL );
			ini_set( 'display_errors', 1 );

			if ( DEBUG_LOG ) {
				ini_set( 'log_errors', 1 );
				//ini_set( 'error_log', Config::getRootDir( '/debug.log' ) );
			}
		} else {
			error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
		}
	}
}