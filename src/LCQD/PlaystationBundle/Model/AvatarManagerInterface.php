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

/**
 * AvatarManagerInterface
 * 
 * @author lechatquidanse
 */
interface AvatarManagerInterface
{
    /**
     * Get one Avatar randomly from existing Avatars
     * 
     * @return Avatar|null
     */
    public function getOneRandom();

    /**
     * Create form for AvatarType
     * 
     * @return FormInterface The form named after the type
     */
    public function createForm();
}
