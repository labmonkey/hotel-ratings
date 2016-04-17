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
			'404' => TwigView::webTemplate( 'pages/404.twig' ),
			'403' => TwigView::webTemplate( 'pages/403.twig' )
		);

		$this->template = get_col( $this->errors, $error, $this->errors['404'] );
	}

	function add_content( $content ) {
		return $content;
	}
}