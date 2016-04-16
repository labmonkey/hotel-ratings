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

		$this->template = TwigView::webTemplate('pages/homepage.twig');

		$this->slug = 'homepage';

		$this->title = 'Hotel Reviews';
	}

	function add_content( $content ) {
		$content = parent::add_content( $content );
		$hotels  = db()->get_entity_manager()->getRepository( 'Hotel' )->findAll();

		$content['hotels'] = $hotels;

		return $content;
	}
}