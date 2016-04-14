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
	private $controllers, $admin, $views, $root, $includes, $uploads, $url;

	/* @var Config */
	private static $_instance;

	function __construct( $root, $url ) {
		$this->root        = "$root/";
		$this->views       = "views/";
		$this->controllers = "controllers/";
		$this->includes    = "includes/";
		$this->uploads     = "uploads/";
		$this->admin       = "admin/";

		$this->url = $url . "/";

		self::$_instance = $this;
	}

	static function getRootDir( $subpath = '' ) {
		return Config::$_instance->root . $subpath;
	}

	static function getRootUrl( $subpath = '' ) {
		return Config::$_instance->url . $subpath;
	}

	static function getAdminUrl( $subpath = '' ) {
		return self::getRootUrl( Config::$_instance->admin . $subpath );
	}

	static function getViewsDir( $subpath = '' ) {
		return self::getRootDir( Config::$_instance->views . $subpath );
	}

	static function getViewsUrl( $subpath = '' ) {
		return self::getRootUrl( Config::$_instance->views . $subpath );
	}

	static function getIncludesDir( $subpath = '' ) {
		return self::getRootDir( Config::$_instance->includes . $subpath );
	}

	static function getUploadsUrl( $subpath = '' ) {
		return self::getRootUrl( Config::$_instance->uploads . $subpath );
	}

	static function getUploadsDir( $subpath = '' ) {
		return self::getRootDir( Config::$_instance->uploads . $subpath );
	}
}