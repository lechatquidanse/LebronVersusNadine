<?php

namespace LCQD\AppBundle\DataFixtures\ORM;

use LCQD\AppBundle\DataFixtures\ORM\Processor\AvatarPictureProcessor;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

/**
 * AppFixtures
 * 
 * @ignore
 * @author lechatquidanse
 */
class AppFixtures extends DataFixtureLoader
{
    /**
     * {@inheritdoc}
     */
    protected function getFixtures()
    {
        return  array(
            __DIR__ . '/../avatars.yml',
            __DIR__ . '/../users.yml',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function getProcessors()
    {
        return array(
            new AvatarPictureProcessor()
            );
    }
}
