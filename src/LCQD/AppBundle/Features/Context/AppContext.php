<?php

/**
 * This file is part of the App package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LCQD\AppBundle\Features\Context;

use LCQD\Component\Features\Context\BaseContext;

/**
 * AppContext
 * 
 * Defines application features from the specific context.
 * 
 * @author lechatquidanse
 * @todo Fix mink catch redirection
 */
class AppContext extends BaseContext
{
    /**
     * User Manager
     * 
     * @var FOS\UserBundle\Model\UserManager
     */
    protected $userManager;

    /**
     * Avatar Manager
     * 
     * @var LCQD\PlaysationBundle\AvatarManagerInterace
     */
    protected $avatarManager;

    /**
     * @BeforeScenario
     */
    public function gatherManager()
    {
        $this->userManager = $this->getService('fos_user.user_manager');
        $this->avatarManager = $this->getService('lcqd_playstation.avatar.manager');
    }
}
