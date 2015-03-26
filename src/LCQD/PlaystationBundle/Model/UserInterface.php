<?php

namespace LCQD\PlaystationBundle\Model;

use LCQD\PlaystationBundle\Model\AvatarInterface;

/**
 * User Interface
 * 
 * @author lechatquidanse
 */
interface UserInterface
{
    /**
     * Set Funds
     * 
     * @param float $funds
     * @return User
     */
    public function setFunds($funds);

    /**
     * Get Funds
     * 
     * @return User
     */
    public function getFunds();

    /**
     * Set Avtar for user
     * 
     * @param AvatarInterface $avatar
     * @return User
     */
    public function setAvatar(AvatarInterface $avatar);

    /**
     * Get Avatar
     * 
     * @return AvatarInterface
     */
    public function getAvatar();

    /**
     * Set Roles for User
     * @param array $roles
     */
    public function setRoles(array $roles);

    /**
     * Get Default Roles of User
     * 
     * @return array of ROLE
     */
    public function getDefaultRoles();

    /**
     * Get Default Roles for User
     */
    public function setDefaultRoles();
}
