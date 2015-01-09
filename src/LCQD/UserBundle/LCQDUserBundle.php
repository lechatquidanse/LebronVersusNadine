<?php

namespace LCQD\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LCQDUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
