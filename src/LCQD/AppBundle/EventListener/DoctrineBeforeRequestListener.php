<?php

namespace LCQD\AppBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Knp\DoctrineBehaviors\Reflection\ClassAnalyzer;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * DoctrineBeforeRequestListener
 * 
 * @author lechatquidanse
 */
class DoctrineBeforeRequestListener
{
    /**
     * $em
     * 
     * @var EntityManager
     */
    protected $em;

    /**
     * $classAnalyzer
     * 
     * @var ClassAnalyzer
     */
    protected $classAnalyzer;

    public function __construct(EntityManager $em, ClassAnalyzer $classAnalyzer)
    {
        $this->em = $em;
        $this->classAnalyzer = $classAnalyzer;
    }

    /**
     * [onKernelRequest description]
     * @param  GetResponseEvent $event [description]
     * @return [type]                  [description]
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $filter = $this->em->getFilters()
            ->enable('entity_enabled');

        $filter->setClassAnalyzer($this->classAnalyzer);
        $filter->setParameter('enabled', true);
    }
}
