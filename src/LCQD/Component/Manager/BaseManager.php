<?php

namespace LCQD\Component\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * BaseManager
 * 
 * @author lechatquidanse
 */
abstract class BaseManager implements ManagerInterface
{
    protected $om;
    protected $entityClass;
    protected $repository;
    protected $formFactory;

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
     * Persist an entity
     * 
     * @param  object $entity
     * @return null
     */
    protected function persist($entity)
    {
        $this->om->persist($entity);
    }

    /**
     * Flush 
     * 
     * @return null
     */
    protected function flush()
    {
        $this->om->flush();
    }

    /**
     * Persist an entity and then flush
     * 
     * @param  object $entity 
     * @return null
     */
    protected function persistAndFlush($entity)
    {
        $this->persist($entity);
        $this->flush();
    }

    /**
     * Create one instance of $this->entityClass
     * 
     * @return object
     */
    protected function create()
    {
        return new $this->entityClass();
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
