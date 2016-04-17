<?php

/**
 * Author: Paweł Derehajło
 * Company: Airnauts
 * Contact: pawel@airnauts.com, derehajlo@gmail.com
 * Date: 16/04/16
 *
 * Summary:
 * TODO summary of this file
 */
class Authentication {

	function __construct() {
		$this->init();
	}

	function init() {
		if ( isset( $_REQUEST["action"] ) ) {
			if ( $_REQUEST["action"] == "login" ) {
				$this->handleLogin( $_REQUEST );
			} else if ( $_REQUEST["action"] == "register" ) {
				$this->handleRegistration( $_REQUEST );
			} else if ( $_REQUEST["action"] == "logout" ) {
				$this->logout();
			}
		}
	}

	/**
	 * @param User $user
	 */
	function login( $user ) {
		session()->start();
		session()->set_current_user( $user );

		header( 'Location: /' );
		exit;
	}

	function logout() {
		session()->stop();
	}

	function register( $data ) {
		$user = new User();
		$user->setFirstName( get_col( $data, 'first-name' ) );
		$user->setLastName( get_col( $data, 'last-name' ) );
		$user->setAdmin( false );
		$user->setEmail( get_col( $data, 'email' ) );
		$user->setPassword( get_col( $data, 'password' ) );

		db()->save( $user );

		$this->login( $user );
	}

	function handleLogin( $post ) {
		$data = array(
			'email'    => $post['email'],
			'password' => $post['password'],
		);

		if ( ! empty( $messages = $this->validateLogin( $data ) ) ) {
			session()->addMessages( $messages );
		} else {
			$user = db()->getTable( 'User' )->findOneBy( array( 'email' => $data['email'] ) );

			if ( ! empty( $user ) ) {
				$password = $user->getPassword();
				if ( password_is_valid( $data['password'], $password ) ) {
					$this->login( $user );
				}
			} else {
				$messages['login'] = "User doesn't exist";
				session()->addMessages( $messages );
			}
		}
	}

	function handleRegistration( $post ) {
		$data = array(
			'first-name'      => $post['first_name'],
			'last-name'       => $post['last_name'],
			'email'           => $post['email'],
			'password'        => $post['password'],
			'password-repeat' => $post['password_repeat']
		);

		if ( ! empty( $messages = $this->validateRegistration( $data ) ) ) {
			session()->addMessages( $messages );
		} else {
			$this->register( $data );
		}
	}

	function validateLogin( $data ) {
		$message = array();

		if ( $email = get_col( $data, 'email' ) ) {
			if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
				$message['email'] = 'Invalid email address';
			}
		} else {
			$message['email'] = 'Email is required';
		}

		if ( $password = get_col( $data, 'password' ) ) {

		} else {
			$message['password'] = 'Password is required';
		}

		return $message;
	}

	function validateRegistration( $data ) {
		$message = array();

		/* First name */

		if ( $first = get_col( $data, 'first-name' ) ) {
			if ( strlen( $first ) > 100 ) {
				$message['first-name'] = 'First name should contain maximum of 100 characters';
			}
		} else {
			$message['first-name'] = 'First name is required';
		}

		/* Last name */

		if ( $last = get_col( $data, 'last-name' ) ) {
			if ( strlen( $last ) > 100 ) {
				$message['last-name'] = 'Last name should contain maximum of 100 characters';
			}
		} else {
			$message['last-name'] = 'Last name is required';
		}

		/* Email */

		if ( $email = get_col( $data, 'email' ) ) {
			if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
				$message['email'] = 'Invalid email address';
			}
		} else {
			$message['email'] = 'Email is required';
		}

		/* Password */

		if ( $password = get_col( $data, 'password' ) ) {
			if ( strlen( $password ) < 8 ) {
				$message['password'][] = 'Password should contain at least 8 characters';
			}
			if ( ! preg_match( '/(?=.*\d)/i', $password ) ) {
				$message['password'][] = 'Password should contain at least 1 number';
			}
		} else {
			$message['password'] = 'Password is required';
		}

		/* Password repeat */

		if ( $repeat = get_col( $data, 'password-repeat' ) ) {
			if ( $repeat !== $password ) {
				$message['password-repeat'] = 'Passwords did not match';
			}
		} else {
			$repeat['password-repeat'] = 'Password repeat is required';
		}

		return $message;
	}
}