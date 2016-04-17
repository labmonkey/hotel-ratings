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

		$this->template = TwigView::adminTemplate( 'pages/admin.twig' );
	}

	function add_content( $content ) {
		$content = parent::add_content( $content );

		$reviews = db()->getTable( 'Review' )->findBy( array( 'moderated' => false ) );

		foreach ( $reviews as $review ) {
			$content['reviews'][] = array(
				'id'        => $review->getId(),
				'rating'    => $review->getRating(),
				'hotel'     => $review->getHotel(),
				'text'      => $review->getMessage(),
				'user'      => $review->getReviewer(),
				'moderated' => $review->getModerated()
			);
		}

		return $content;
	}

	function handleForms( $action, $data ) {
		parent::handleForms( $action, $data );
		if ( $action === 'moderate-review' ) {
			$review = db()->load( 'Review', $data['id'] );

			$review->setMessage( $data['message'] );
			$review->setModerated( true );

			db()->update( $review );
		}
	}
}