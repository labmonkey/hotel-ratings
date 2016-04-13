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
class ErrorController extends Controller {

	private $errors;

	function __construct( $view, $error ) {
		parent::__construct( $view );

		$this->errors = array(
			'404' => 'pages/404.twig'
		);

		$this->template = get_col( $this->errors, $error, $this->errors['404'] );

		$this->content = array( 'test' => 'lol' );
	}

}