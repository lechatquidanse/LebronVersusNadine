<?php

namespace LCQD\PlaystationBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\NoResultException;

/**
 * AvatarRepository
 * 
 * @author lechatquidanse
 */
class AvatarRepository extends EntityRepository
{
    /**
     * Get an Avatar randomly
     *
     * @throws NoResultException when no result was found
     * @return Avatar
     */
    public function getOneRandom()
    {
        $count = $this->createQueryBuilder('a')
             ->select('COUNT(a)')
             ->getQuery()
             ->getSingleScalarResult();
        
        return $this->createQueryBuilder('a')
                ->setFirstResult(rand(0, $count - 1))
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleResult();
    }
}
