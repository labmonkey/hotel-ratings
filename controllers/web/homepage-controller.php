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

		$this->template = TwigView::webTemplate( 'pages/homepage.twig' );

		$this->slug = 'homepage';

		$this->title = 'Hotel Reviews';
	}

	function add_content( $content ) {
		$content = parent::add_content( $content );
		$hotels  = db()->get_entity_manager()->getRepository( 'Hotel' )->findAll();

		$user = session()->get_current_user();

		foreach ( $hotels as &$hotel ) {
			$hotel->rating   = $this->calculate_rating( $hotel );
			$hotel->reviewed = false;

			foreach ( $hotel->getReviews() as $review ) {
				$hotel->reviewsalt[] = array(
					'id'        => $review->getId(),
					'rating'    => $review->getRating(),
					'hotel'     => $review->getHotel(),
					'text'      => $review->getMessage(),
					'user'      => $review->getReviewer(),
					'moderated' => $review->getModerated()
				);
				if ( $user && ( $review->getReviewer()->getId() == $user->getId() ) ) {
					$hotel->reviewed = true;
				}
			}
		}

		$content['hotels'] = $hotels;

		return $content;
	}

	function handleForms( $action, $data ) {
		parent::handleForms( $action, $data );
		if ( $action === 'add-review' ) {
			$user  = session()->get_current_user();
			$hotel = db()->load( 'Hotel', $data['id'] );

			$review = new Review();
			$review->setReviewer( $user );
			$review->setRating( $data['rating'] );
			$review->setMessage( $data['message'] );
			$review->setHotel( $hotel );
			$review->setModerated( false );

			db()->update( $review );
		}
	}

	function calculate_rating( $hotel ) {
		$sum     = 0;
		$reviews = $hotel->getReviews();

		foreach ( $reviews as $review ) {
			$sum += $review->getRating();
		}

		return (int) ( $sum / count( $reviews ) );
	}
}