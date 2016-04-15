<?php

/**
 * Author: Paweł Derehajło
 * Company: Airnauts
 * Contact: pawel@airnauts.com, derehajlo@gmail.com
 * Date: 09/04/16
 *
 * Summary:
 * TODO summary of this file
 */
class AccountController extends Controller {
	function __construct( $view ) {
		parent::__construct( $view );

		$this->template = 'pages/account.twig';

		$this->slug = 'account';

		$this->title = 'My account';
	}

	function add_content( $content ) {
		$content = parent::add_content( $content );

		return $content;
	}
}