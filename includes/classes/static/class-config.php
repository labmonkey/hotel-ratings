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
class Config {
	private $controllers, $views, $root, $includes, $url;

	/* @var Config */
	private static $_instance;

	function __construct( $root, $url ) {
		$this->root        = "$root/";
		$this->views       = "$root/views/";
		$this->controllers = "$root/controllers/";
		$this->includes    = "$root/includes/";

		$this->url = $url;

		self::$_instance = $this;
	}

	static function getAdminDir( $subpath = '' ) {
		return $subpath;
	}

	static function getAdminUrl( $subpath = '' ) {
		return $subpath;
	}

	static function getViewsDir( $subpath = '' ) {
		return Config::$_instance->views . $subpath;
	}

	static function getRootDir( $subpath = '' ) {
		return Config::$_instance->root . $subpath;
	}

	static function getRootUrl( $subpath = '' ) {
		return Config::$_instance->url . $subpath;
	}

	static function getIncludesDir( $subpath = '' ) {
		return Config::$_instance->includes . $subpath;
	}
}