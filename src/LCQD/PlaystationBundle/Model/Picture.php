<?php

namespace LCQD\PlaystationBundle\Model;

/**
 * Picture
 * 
 * @author lechatquidanse
 */
abstract class Picture
{
    abstract public function getName();

    /**
     * Get the absolute path of the picture
     *
     * @return string
     */
    public function getAbsolutePicture()
    {
        return null === $this->getName() ? null : $this->getUploadRootDir() . '/' . $this->getName();
    }

    /**
     * Get the web path of the picture
     *
     * @return string
     */
    public function getWebPicture()
    {
        return null === $this->getName() ? null : $this->getUploadDir() . '/' . $this->getName();
    }

    /**
     * Get the upload root dir
     *
     * @param string $folderName The folder name
     *
     * @return string
     */
    protected function getUploadRootDir($folderName = null)
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir($folderName);
    }

    /**
     * get the upload dir
     *
     * @param string $folderName The folder name
     *
     * @return string
     */
    protected function getUploadDir($folderName = null)
    {
        return 'uploads/avatar/pictures' . ($folderName === null ? '' : '/' . $folderName);
    }
}
