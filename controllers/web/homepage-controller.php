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
class HomepageController extends Controller {
	function __construct( $view ) {
		parent::__construct( $view );

		$this->template = 'pages/homepage.twig';
	}

	function add_content( $content ) {
		$users = db()->get_entity_manager()->getRepository( 'User' )->findAll();

		$content['users'] = $users;
		
		return $content;
	}
}