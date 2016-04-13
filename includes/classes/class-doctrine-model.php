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

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class DoctrineModel extends Model {
	/* @var Doctrine\ORM\EntityManager */
	private $entityManager;

	function __construct() {
		$this->get_entity_manager();
	}

	public function get_entity_manager() {
		if ( ! empty( $this->entityManager ) ) {
			return $this->entityManager;
		}
		// Create a simple "default" Doctrine ORM configuration for Annotations
		$isDevMode = true;
		$config    = Setup::createYAMLMetadataConfiguration( array(
			Config::getIncludesDir( "model/mappings" )
		),
			$isDevMode
		);

		$file = Config::getIncludesDir( 'model/database/db.sqlite' );
		// database configuration parameters
		$conn = array(
			'driver' => 'pdo_sqlite',
			'path'   => $file,
		);

		if ( ! is_writable( dirname( $file ) ) ) {
			chown( dirname( $file ), 'www-data' );
			chown( $file, 'www-data' );
		}

		// obtaining the entity manager
		$entityManager = EntityManager::create( $conn, $config );

		$this->entityManager = $entityManager;

		return $entityManager;
	}

	function save( $object ) {
		$this->entityManager->persist( $object );
		$this->entityManager->flush();
	}

	function load( $table, $ID ) {
		return $this->entityManager->find( $table, $ID );
	}
}