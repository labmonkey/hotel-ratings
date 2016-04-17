<?php
/**
 * Author: Paweł Derehajło
 * Company: Airnauts
 * Contact: pawel@airnauts.com, derehajlo@gmail.com
 * Date: 17/04/16
 *
 * Summary:
 * TODO summary of this file
 */

use Doctrine\ORM\EntityRepository;

class HotelRepository extends EntityRepository {

	public function getHotelsExcludingReviewed( $user ) {
		$builder = $this->getEntityManager()->createQueryBuilder();

		$reviewed = $user->getReviews();

		$query = $builder->select( 'h' )->from( 'Hotel', 'h' )->where( $builder->expr()->
		notIn( 'h.id', $reviewed->getDQL() ) )
		                 ->getQuery();

		return $query->getArrayResult();
	}

	public function getRecentBugs( $number = 30 ) {
		$dql = "SELECT b, e, r FROM Bug b JOIN b.engineer e JOIN b.reporter r ORDER BY b.created DESC";

		$query = $this->getEntityManager()->createQuery( $dql );
		$query->setMaxResults( $number );

		return $query->getResult();
	}

	public function getRecentBugsArray( $number = 30 ) {
		$dql   = "SELECT b, e, r, p FROM Bug b JOIN b.engineer e " .
		         "JOIN b.reporter r JOIN b.products p ORDER BY b.created DESC";
		$query = $this->getEntityManager()->createQuery( $dql );
		$query->setMaxResults( $number );

		return $query->getArrayResult();
	}

	public function getUsersBugs( $userId, $number = 15 ) {
		$dql = "SELECT b, e, r FROM Bug b JOIN b.engineer e JOIN b.reporter r " .
		       "WHERE b.status = 'OPEN' AND e.id = ?1 OR r.id = ?1 ORDER BY b.created DESC";

		return $this->getEntityManager()->createQuery( $dql )
		            ->setParameter( 1, $userId )
		            ->setMaxResults( $number )
		            ->getResult();
	}

	public function getOpenBugsByProduct() {
		$dql = "SELECT p.id, p.name, count(b.id) AS openBugs FROM Bug b " .
		       "JOIN b.products p WHERE b.status = 'OPEN' GROUP BY p.id";

		return $this->getEntityManager()->createQuery( $dql )->getScalarResult();
	}
}