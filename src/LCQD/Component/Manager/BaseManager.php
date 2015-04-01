<?php

/**
 * This file is part of the Component package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LCQD\Component\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * BaseManager
 *
 * Abstract Base Manager used for common action for manager handling an entity
 * 
 * @author lechatquidanse
 */
abstract class BaseManager implements ManagerInterface
{
    /**
     * om
     *
     * Object Manager
     * 
     * @var ObjectManager
     */
    protected $om;

    /**
     * Entity Class
     *
     * Entity Class Name
     * 
     * @var string
     */
    protected $entityClass;
    
    /**
     * Repository
     *
     * Entity Repository
     * 
     * @var EntityRepository
     */
    protected $repository;

    /**
     * Form Factory
     * 
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * Constructor
     * 
     * @param ObjectManager        $om        
     * @param string               $entityClass
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $id
     * @return Object
     */
    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * {@inheritdoc}
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
     * @param  Object $entity 
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
     * @return Object
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
