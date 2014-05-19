<?php

namespace Pn\PnBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * BabysitterRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BabysitterRepository extends EntityRepository
{
    public function getFromSearch($search, $max = null)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->leftJoin('b.user', 'u')
            ->where('u.address LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->orderBy('b.trustpoints', 'DESC');

        if($max)
        {
            $qb->setMaxResults($max);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function getFromGoogleSearch($top, $bottom, $left, $right, $max = null)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->leftJoin('b.user', 'u')
            ->where('u.latitude < :top')
            ->setParameter('top', $top)
            ->andWhere('u.latitude > :bottom')
            ->setParameter('bottom', $bottom)
            ->andWhere('u.longitude > :left')
            ->setParameter('left', $left)
            ->andWhere('u.longitude < :right')
            ->setParameter('right', $right)
            ->orderBy('b.trustpoints', 'DESC');

        if($max)
        {
            $qb->setMaxResults($max);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findAllOrderedByTrustpoints($max = null)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->leftJoin('b.user', 'u')
            ->orderBy('b.trustpoints', 'DESC');

        if($max)
        {
            $qb->setMaxResults($max);
        }

        $query = $qb->getQuery();

        return $query->getResult();
    }
}
