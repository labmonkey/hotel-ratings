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

		$this->template = TwigView::webTemplate( '/pages/account.twig' );

		$this->slug = 'account';

		$this->title = 'My account';
	}

	function add_content( $content ) {
		$content = parent::add_content( $content );

		$reviews = session()->get_current_user()->getReviews();
		
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
		if ( $action === 'update-account' ) {
			$validate = array(
				'first-name'      => $data['first_name'],
				'last-name'       => $data['last_name'],
				'email'           => $data['email'],
				'password'        => $data['password'],
				'password-repeat' => $data['password']
			);

			$valid = app()->getAuthentication()->validateRegistration( $validate );

			if ( empty( $valid ) ) {
				$user = session()->get_current_user();

				$user->setFirstName( $data['first_name'] );
				$user->setLastName( $data['last_name'] );
				$user->setEmail( $data['email'] );
				$user->setPassword( password_to_hash( $data['password'] ) );

				db()->update( $user );
			} else {
				session()->addMessages( $valid );
			}
		}
	}
}