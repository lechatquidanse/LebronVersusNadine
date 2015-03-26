<?php

namespace LCQD\PlaystationBundle\Model;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User Model
 * 
 * @author lechatquidanse
 */
abstract class User extends BaseUser implements UserInterface
{
    /**
     * Role Api User name
     */
    const __ROLE_API_USER__ = 'ROLE_API_USER';
    
    /**
     * Default funds for User
     */
    const __DEFAULT_FUNDS__ = 100.00;

    /**
     * __construct
     * Set Default Roles for User and call parent
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultRoles();
    }

    /**
     * Set Default Funds for User
     */
    public function setDefaultFunds()
    {
        $this->setFunds(self::__DEFAULT_FUNDS__);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultRoles()
    {
        return array(self::__ROLE_API_USER__);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultRoles()
    {
        $this->setRoles($this->getDefaultRoles());
    }
}
