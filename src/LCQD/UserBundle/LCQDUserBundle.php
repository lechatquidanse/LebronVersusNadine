<?php

namespace LCQD\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * LCQDUserBundle
 * 
 * @author lechatquidanse
 */
class LCQDUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
