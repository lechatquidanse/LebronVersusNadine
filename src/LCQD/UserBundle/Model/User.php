<?php

namespace LCQD\UserBundle\Model;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 * 
 * @author lechatquidanse
 */
abstract class User extends BaseUser implements UserInterface
{
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultRoles();
    }

    public function getEnabledAvatar()
    {
        $avatar = $this->getAvatar();

        if (!$avatar || !$avatar->isEnabled()) {
            throw new \Exception("No avatar found for User", 1);
        }

        return $avatar;
    }

    public function getDefaultRoles()
    {
        return array('ROLE_API_USER');
    }

    public function setDefaultRoles()
    {
        $this->setRoles($this->getDefaultRoles());
    }
}
