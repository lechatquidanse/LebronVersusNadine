<?php

/**
 * This file is part of the Playstation package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LCQD\PlaystationBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Avatar Interface
 * 
 * Avatar is used to give a personnage for a user of the api
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
     * @return AvatarInterface
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
     * @return AvatarInterface
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
     * @return AvatarInterface
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
     * @return AvatarInterface
     */
    public function setBirthdayAt(\Datetime $birthdayAt = null);

    /**
     * Get birthday at
     * 
     * @return Datetime
     */
    public function getBirthdayAt();

    /**
     * Set Price
     * 
     * @param float $price
     * @return AvatarInterface
     */
    public function setPice($price);

    /**
     * Get Price
     * 
     * @return float
     */
    public function getPrice();

    /**
     * Set users
     * 
     * @param ArrayCollection $users
     * @return AvatarInterface
     */
    public function setUsers(ArrayCollection $users);

    /**
     * Add a new picture
     *
     * @param PictureInterface $picture The picture
     * @return AvatarInterface
     */
    public function addPicture(PictureInterface $picture);

    /**
     * Remove a picture
     *
     * @param PictureInterface $picture The picture
     * @return AvatarInterface
     */
    public function removePicture(PictureInterface $picture);

    /**
     * Set all pictures
     * 
     * @param ArrayCollection $pictures
     * @return AvatarInterface
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
