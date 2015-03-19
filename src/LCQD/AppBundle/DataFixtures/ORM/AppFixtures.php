<?php

namespace LCQD\AppBundle\DataFixtures\ORM;

use LCQD\AppBundle\DataFixtures\ORM\Processor\AvatarPictureProcessor;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

/**
 * AppFixtures
 * 
 * @author lechatquidanse
 */
class AppFixtures extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
        return  array(
            __DIR__ . '/../avatars.yml',
            __DIR__ . '/../users.yml',
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
    
    /**
     * {@inheritDoc}
     */
    protected function getProcessors()
    {
        return array(
            new AvatarPictureProcessor()
            );
    }
}
