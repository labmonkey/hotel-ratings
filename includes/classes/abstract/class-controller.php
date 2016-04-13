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
class Controller {
	protected $template, $content;

	/* @var View */
	protected $view;

	function __construct( $view ) {
		$this->view = $view;

		$this->content = $this->add_content( array() );
	}

	/**
	 * @param $content
	 *
	 * @return array
	 */
	function add_content( $content ) {
		return $content;
	}

	function display() {
		$this->view->render( $this->template, $this->content );
	}
}