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

$hotels = array(
	array(
		'name'        => 'Hotel Rock',
		'description' => 'Excellent business hotel. Close to the city center and public transportation. New facilities and friendly service. Fair breakfast prices. Popular among solo travelers.',
		'image'       => 'hotel-rock.jpg'
	),
	array(
		'name'        => 'Hotel Jazz',
		'description' => 'Very good luxury hotel. Close to Starbucks. Close to public transportation and the train station. Awesome terrace. Nice sauna. Bar is awesome. Popular among business travelers.',
		'image'       => 'hotel-jazz.jpg'
	),
	array(
		'name'        => 'Hotel Pop',
		'description' => 'Excellent city hotel. Close to restaurants, bars and train stations. Free internet. Clean hotel facilities. Great reception. Popular among solo travelers.',
		'image'       => 'hotel-pop.jpg'
	)
);

foreach ( $hotels as $data ) {
	$hotel = new Hotel();
	$hotel->setName( $data['name'] );
	$hotel->setDescription( $data['description'] );
	$hotel->setImage( $data['image'] );

	db()->save( $hotel );
}

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
		'email'      => 'joey@test.com',
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

	$review = new Review();
	$review->setMessage( "test " . rand( 100, 1000 ) );
	$review->setRating( rand( 1, 5 ) );
	$review->setReviewer( $user );

	db()->save( $review );
}
