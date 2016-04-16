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

	/* @var Model */
	private $model;

	/* @var SessionManager */
	private $session;

	function __construct() {
		$this->view = new TwigView();

		global $entityManager;
		$this->model = new DoctrineModel( $entityManager );
	}

	function init() {
		$this->session  = new SessionManager();
		$authentication = new Authentication();

		$path              = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
		$this->coordinator = new RequestCoordinator( $path );
		$this->controller  = $this->coordinator->get_controller( $path );

		$this->view->init();

		$this->controller->display();
	}

	function getView() {
		return $this->view;
	}

	function getModel() {
		return $this->model;
	}

	function is_admin() {
		return $this->coordinator->is_admin();
	}

	function getSession() {
		return $this->session;
	}
}