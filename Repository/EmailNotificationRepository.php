<?php

namespace Flowcode\NotificationBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Flower\ModelBundle\Entity\EmailNotification;
/**
 * EmailNotificationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EmailNotificationRepository extends EntityRepository
{
	public function getAllPendingNotifications(){
		$qb = $this->createQueryBuilder("ne");
        $qb->where("ne.status = :status");
        $qb->setParameter("status", EmailNotification::$STATUS_PENDING);
        return $qb->getQuery()->getResult();
	}
	public function countAllPendingNotifications(){
		$qb = $this->createQueryBuilder("ne");
		$qb->select('COUNT(ne)');
        $qb->where("ne.status = :status");
        $query = $qb->setParameter("status", EmailNotification::$STATUS_PENDING)->getQuery();
        return $query->getSingleScalarResult();
	}
}
