<?php

namespace LCQD\PlaystationBundle\Manager;

use LCQD\AppCommonBundle\Manager\BaseManager;

/**
 * AvatarManager
 * 
 * @author lechatquidanse
 */
class AvatarManager extends BaseManager implements AvatarManagerInterface
{
    /**
     * [getOneRandom description]
     * @return [type] [description]
     */
    public function getOneRandom()
    {
        return $this->getRepository()->getOneRandom();
    }
}
