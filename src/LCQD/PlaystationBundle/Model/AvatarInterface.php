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
     * @param boolean $isEnabled
     * @return Avatar
     */
    public function setIsEnabled($isEnabled);
    
    /**
     * @return boolean
     */
    public function getIsEnabled();

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

    /**
     * @param Datetime $createdAt
     * @return Avatar
     */
    public function setCreatedAt(\Datetime $createdAt);

    /**
     * @return Datetime
     */
    public function getCreatedAt();

    /**
     * @param Datetime $updatedAt
     * @return Avatar
     */
    public function setUpdatedAt(\Datetime $updatedAt);

    /**
     * @return datetime
     */
    public function getUpdatedAt();
}
