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
class Application {
	/* @var Controller */
	private $controller;

	/* @var RequestCoordinator */
	private $coordinator;

	private $view, $config;

	function __construct() {
		$this->view = new TwigView();
		$this->view->init();
	}

	function init() {
		$path              = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
		$this->coordinator = new RequestCoordinator();

		$this->controller = $this->coordinator->get_controller( $path );

		$this->controller->display();
	}

	function getView() {
		return $this->view;
	}
}