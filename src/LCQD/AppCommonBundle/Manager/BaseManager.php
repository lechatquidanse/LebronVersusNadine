<?php

namespace LCQD\AppCommonBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormFactoryInterface;

abstract class BaseManager implements ManagerInterface
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get an Entity.
     *
     * @param mixed $id
     *
     * @return PageInterface
     */
    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * Get a list of Entities.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->getRepository()->findBy(array(), null, $limit, $offset);
    }

    /**
     * Get Repository Entity
     * 
     * @return EntityRepository
     */
    protected function getRepository()
    {
        return $this->repository;
    }
}
