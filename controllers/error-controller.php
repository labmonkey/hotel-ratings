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

	private $errors, $code;

	function __construct( $view, $code ) {
		parent::__construct( $view );

		$this->code = $code;

		$this->slug = 'error';

		$this->errors = array(
			'404' => "Page doesn't exist",
			'403' => "Restricted access"
		);

		$this->title = "Error occured";

		$this->template = TwigView::webTemplate( 'pages/error.twig' );
	}

	function add_content( $content ) {
		$content = parent::add_content( $content );
		$error   = get_col( $this->errors, $this->code, $this->errors['404'] );

		$content['error'] = array(
			'code' => $this->code,
			'text' => $error,
			'link' => Config::getRootUrl()
		);

		return $content;
	}
}