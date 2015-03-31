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
use LCQD\PlaystationBundle\Entity\Picture;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Picture Interface
 * 
 * Picture is used to add multi pictures to an avatar
 * 
 * @author lechatquidanse
 */
interface PictureInterface
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     * @return PictureInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set caption
     *
     * @param string $caption
     * @return PictureInterface
     */
    public function setCaption($caption);

    /**
     * Get caption
     *
     * @return string
     */
    public function getCaption();

    /**
     * Set the avatar
     *
     * @param AvatarInterface $avatar The avatar
     *
     * @return PictureInterface
     */
    public function setAvatar(AvatarInterface $avatar);

    /**
     * Get the avatar
     *
     * @return AvatarInterface
     */
    public function getAvatar();

    /**
     * Set the file
     *
     * @param File $file The file
     * @return PictureInterface
     */
    public function setFile(File $file);

    /**
     * Get the file
     *
     * @return File
     */
    public function getFile();

    /**
     * Make the filename
     */
    public function preUpload();

    /**
     * Upload the file
     */
    public function upload();

    /**
     * Remove the file
     */
    public function removeUpload();

    /**
     * Check if the picture is valid.
     *
     * The picture is valid if the name is not null or the name is null and the
     * file is not null
     *
     * @param ExecutionContextInterface $context The validator context
     * @return boolean
     */
    public function isPictureValid(ExecutionContextInterface $context);

    /**
     * Web path
     * 
     * Return the web path
     * 
     * @return int
     */
    public function webPath();

    /**
     * Get the absolute path of the picture
     *
     * @return string
     */
    public function getAbsolutePicture();

    /**
     * Get the web path of the picture
     *
     * @return string
     */
    public function getWebPicture();
}
