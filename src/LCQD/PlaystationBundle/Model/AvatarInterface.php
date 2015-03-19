<?php

namespace LCQD\PlaystationBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use LCQD\PlaystationBundle\Entity\Picture;

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
     * Set Firstname
     * 
     * @param string $firstname
     * @return Avatar
     */
    public function setFirstname($firstname);

    /**
     * Get Firstname
     * 
     * @return string
     */
    public function getFirstname();

    /**
     * Set Lastname
     * 
     * @param string $lastname
     * @return Avatar
     */
    public function setLastname($lastname);

    /**
     * Get Lastname
     * 
     * @return string
     */
    public function getLastname();

    /**
     * Set About me
     * 
     * @param string $aboutMe
     * @return Avatar
     */
    public function setAboutMe($aboutMe);

    /**
     * Get about me
     * 
     * @return string
     */
    public function getAboutMe();

    /**
     * Set birthday at
     * 
     * @param Datetime $birthdayAt
     * @return Avatar
     */
    public function setBirthdayAt(\Datetime $birthdayAt = null);

    /**
     * Get birthday at
     * 
     * @return Datetime
     */
    public function getBirthdayAt();


    /**
     * Set users
     * 
     * @param ArrayCollection $users
     * @return Avatar
     */
    public function setUsers(ArrayCollection $users);

    /**
     * Add a new picture
     *
     * @param Picture $picture The picture
     *
     * @return Avatar
     */
    public function addPicture(Picture $picture);

    /**
     * Remove a picture
     *
     * @param Picture $picture The picture
     *
     * @return Avatar
     */
    public function removePicture(Picture $picture);

    /**
     * Set all pictures
     * 
     * @param ArrayCollection $pictures
     *
     * @return Avatar
     */
    public function setPictures(ArrayCollection $pictures);

    /**
     * Get all pictures
     *
     * @return ArrayCollection
     */
    public function getPictures();

    /**
     * getUsers
     * 
     * @return ArrayCollection|null
     */
    public function getUsers();

    /**
     * Count Users
     * Return the number of users that use this avatar
     * 
     * @return int
     */
    public function countUsers();

    /**
     * Count Pictures
     * Return the number of pictures for this avatar
     * 
     * @return int
     */
    public function countPictures();
}
