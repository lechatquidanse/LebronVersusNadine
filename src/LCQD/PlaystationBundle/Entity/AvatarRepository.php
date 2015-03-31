<?php

/**
 * This file is part of the Playstation package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LCQD\PlaystationBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\NoResultException;

/**
 * Avatar Repository
 * 
 * Avatar Doctrine query repository
 * 
 * @author lechatquidanse
 */
class AvatarRepository extends EntityRepository
{
    /**
     * Get one random
     * 
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
