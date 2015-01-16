<?php

namespace LCQD\UserBundle\Model;

use LCQD\PlaystationBundle\Model\AvatarInterface as AvatarInterface;

interface UserInterface
{

    /**
     * @param AvatarInterface $avatar
     * @return User
     */
    public function setAvatar(AvatarInterface $avatar);

    /**
     * @return AvatarInterface
     */
    public function getAvatar();

    public function getDefaultRoles();
    public function setDefaultRoles():
}
