<?php

/**
 * This file is part of the Playstation package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
     * @return UserInterface
     */
    public function setFunds($funds);

    /**
     * Get Funds
     * 
     * @return UserInterface
     */
    public function getFunds();

    /**
     * Set Avtar for user
     * 
     * @param AvatarInterface $avatar
     * @return UserInterface
     */
    public function setAvatar(AvatarInterface $avatar);

    /**
     * Get Avatar
     * 
     * @return AvatarInterface
     */
    public function getAvatar();

    /**
     * Set Roles for UserInterface
     * @param array $roles
     */
    public function setRoles(array $roles);

    /**
     * Set Default Funds for User
     */
    public function setDefaultFunds();

    /**
     * Get Default Roles of UserInterface
     * 
     * @return array of ROLE
     */
    public function getDefaultRoles();

    /**
     * Get Default Roles for UserInterface
     */
    public function setDefaultRoles();

    /**
     * Has Funds to Buay Avatar
     *
     * Check if User has engough funds to buy avatar
     * 
     * @param  AvatarInterface $avatar
     * @return boolean
     */
    public function hasFundsToBuyAvatar(AvatarInterface $avatar);

    /**
     * Buy Avatar
     * 
     * @param  AvatarInterface $avatar
     * @return boolean
     */
    public function buyAvatar(AvatarInterface $avatar);
}
