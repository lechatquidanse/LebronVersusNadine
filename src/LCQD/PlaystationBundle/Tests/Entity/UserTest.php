<?php

namespace LCQD\PlaystationBundle\Tests\Entity;

use LCQD\PlaystationBundle\Entity\User;
use LCQD\PlaystationBundle\Entity\Avatar;

/**
 * User Test
 *
 * @author  lechatquidanse
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testSetDefaultRoles
     */
    public function testSetDefaultRoles()
    {
        $user = new User();
        $user->setDefaultRoles();

        $defaultRoles = $user->getDefaultRoles();
        $userRoles = $user->getRoles();

        $result = array_intersect($defaultRoles, $userRoles);

        $this->assertEquals(count($result), count($defaultRoles));
    }

    /**
     * testBuyAvatarFailureNotEnabled
     * 
     * @expectedException InvalidArgumentException
     */
    public function testBuyAvatarFailureNotEnabled()
    {
        $user = new User();
        $user->setFunds(200.00);

        $avatar = new Avatar();
        $avatar->setPrice(50.00);
        $avatar->disabled();

        $user->buyAvatar($avatar);
    }

    /**
     * testBuyAvatarFailureAlreadyUsed
     * 
     * @expectedException Exception
     */
    public function testBuyAvatarFailureAlreadyUsed()
    {
        $user = new User();
        $user->setFunds(200.00);
        
        $avatar = new Avatar();
        $avatar->setPrice(50.00);

        $user->setAvatar($avatar);

        $user->buyAvatar($avatar);
    }

    /**
     * testBuyAvatarFailureNotEnoughFunds
     * 
     * @expectedException Exception
     */
    public function testBuyAvatarFailureNotEnoughFunds()
    {
        $user = new User();
        $user->setFunds(50.00);
        
        $avatar = new Avatar();
        $avatar->setPrice(200.00);

        $user->buyAvatar($avatar);
    }

    /**
     * testBuyAvatarSuccess
     */
    public function testBuyAvatarSuccess()
    {
        $user = new User();
        $user->setFunds(200.00);
        
        $avatar = new Avatar();
        $avatar->setPrice(50.00);

        $user->buyAvatar($avatar);

        $this->assertEquals(150.00, $user->getFunds());
        $this->assertEquals($avatar, $user->getAvatar());
    }
}
