<?php

namespace LCQD\PlaystationBundle\Manager;

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
