<?php

namespace LCQD\PlaystationBundle\Model;

/**
 * Avatar
 * 
 * @author lechatquidanse
 */
abstract class Avatar implements AvatarInterface
{
    public function isEnabled()
    {
        return $this->getIsEnabled();
    }
}
