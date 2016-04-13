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

if ( LOAD_SAMPLE_DATA === false ) {
	return;
}

$wtf = db()->load( 'User', 1 );

$users = array(
	array(
		'first_name' => 'Paweł',
		'last_name'  => 'Derehajło',
		'email'      => 'admin@test.com',
		'password'   => 'password1',
		'admin'      => true
	),
	array(
		'first_name' => 'Joey',
		'last_name'  => 'Test',
		'email'      => 'john@test.com',
		'password'   => 'password1',
		'admin'      => false
	),
	array(
		'first_name' => 'Ross',
		'last_name'  => 'Test',
		'email'      => 'ross@test.com',
		'password'   => 'password1',
		'admin'      => false
	)
);

foreach ( $users as $data ) {
	$user = new User();

	$user->setFirstName( $data['first_name'] );
	$user->setLastName( $data['last_name'] );
	$user->setEmail( $data['email'] );
	$user->setAdmin( $data['admin'] );
	$user->setPassword( password_to_hash( $data['password'] ) );

	db()->save( $user );
}