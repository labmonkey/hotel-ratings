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

	$hotels_db[] = db()->save( $hotel );
}

$users = array(
	array(
		'first_name' => 'Paweł',
		'last_name'  => 'Derehajło',
		'email'      => 'admin@test.com',
		'password'   => 'password1',
		'admin'      => true
	)
);

for ( $i = 0; $i < 10; $i ++ ) {
	$users[] =
		array(
			'first_name' => 'Generated',
			'last_name'  => "User {$i}",
			'email'      => "ross{$i}@test.com",
			'password'   => 'password1',
			'admin'      => false
		);
}

foreach ( $users as $data ) {
	$user = new User();

	$user->setFirstName( $data['first_name'] );
	$user->setLastName( $data['last_name'] );
	$user->setEmail( $data['email'] );
	$user->setAdmin( $data['admin'] );
	$user->setPassword( password_to_hash( $data['password'] ) );

	db()->save( $user );

	shuffle( $hotels_db );

	$limited = array_slice( $hotels_db, 0, rand( 1, 3 ) );

	foreach ( $limited as $hotel ) {
		$review = new Review();
		$review->setHotel( $hotel );
		$review->setMessage( "The hotel is really nice, with a small library where breakfast is served and small snacks in the evening. Staff is very friendly and helpful. Rooms are stylish and a good size with a very nice shower. I would recommend the hotel for couples, but not for families. The downside is the rooftop pool." );
		$review->setRating( rand( 1, 5 ) );
		$review->setReviewer( $user );
		$review->setModerated( rand( 0, 10 ) > 8 ? true : false );

		db()->save( $review );
	}
}
