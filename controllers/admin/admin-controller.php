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
class AdminController extends Controller {
	function __construct( $view ) {
		parent::__construct( $view );

		$this->slug = 'admmin';

		$this->title = 'Administration area';

		$this->template = TwigView::adminTemplate('pages/admin.twig');
	}

	function add_content( $content ) {
		$content = parent::add_content( $content );
		
		return $content;
	}
}