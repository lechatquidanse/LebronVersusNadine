<?php

namespace LCQD\PlaystationBundle\Model;

/**
 * AvatarInterface
 * 
 * @author lechatquidanse
 */
interface AvatarInterface
{
    /**
     * Get id
     * 
     * @return integer
     */
    public function getId();
    
    /**
     * @param string $firstname
     * @return Avatar
     */
    public function setFirstname($firstname);

    /**
     * @return string
     */
    public function getFirstname();

    /**
     * @param string $lastname
     * @return Avatar
     */
    public function setLastname($lastname);

    /**
     * @return string
     */
    public function getLastname();

    /**
     * @param string $aboutMe
     * @return Avatar
     */
    public function setAboutMe($aboutMe);

    /**
     * @return string
     */
    public function getAboutMe();

    /**
     * @param Datetime $birthdayAt
     * @return Avatar
     */
    public function setBirthdayAt(\Datetime $birthdayAt = null);

    /**
     * @return Datetime
     */
    public function getBirthdayAt();
}
