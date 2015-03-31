<?php

/**
 * This file is part of the Playstation package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LCQD\PlaystationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use LCQD\Component\Doctrine\Model as DoctrineModel;
use LCQD\PlaystationBundle\Model\AvatarInterface;
use LCQD\PlaystationBundle\Entity\Avatar;
use LCQD\PlaystationBundle\Model\PictureInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;

/**
 * Picture
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="LCQD\PlaystationBundle\Entity\PictureRepository")
 * @ORM\Table(name="lcqd_picture")
 * 
 * @author lechatquidanse
 */
class Picture implements PictureInterface
{
    /**
     * Add properties, created and updated datetime informations
     */
    use ORMBehaviors\Timestampable\Timestampable;
    
    /**
     * Add property enabled, used as a flag
     */
    use DoctrineModel\Enabled;

    /**
     * Id
     * 
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * Name
     * 
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * 
     * @Serializer\Exclude
     */
    private $name;

    /**
     * Caption
     * 
     * @var string
     *
     * @ORM\Column(name="caption", type="string", length=255, nullable=true)
     */
    private $caption;

    /**
     * Avatar
     * 
     * @var Avatar
     *
     * @ORM\ManyToOne(targetEntity="LCQD\PlaystationBundle\Entity\Avatar", inversedBy="pictures")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id")
     */
    private $avatar;

    /**
     * File
     *
     * @var File
     * 
     * @Assert\Image()
     */
    private $file;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $name
     * @return Picture
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $caption
     * @return Picture
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * {@inheritdoc}
     *
     * @param AvatarInterface $avatar The avatar
     * @return Picture
     */
    public function setAvatar(AvatarInterface $avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * {@inheritdoc}
     *
     * @param File $file The file
     * @return Picture
     */
    public function setFile(File $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * {@inheritdoc}
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            $this->name = md5(($this->avatar instanceof Avatar ? '' : $this->avatar->getFirstname()) . $this->avatar->getFirstname() . mt_rand(0, 10000)) . '.' . $this->file->guessExtension();
        }
    }

    /**
     * {@inheritdoc}
     *
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null !== $this->file) {
            $this->file->move($this->getUploadRootDir(), $this->name);
            $this->file = null;
        }
    }

    /**
     * {@inheritdoc}
     *
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePicture()) {
            unlink($file);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @param ExecutionContextInterface $context The validator context
     * @return boolean
     */
    public function isPictureValid(ExecutionContextInterface $context)
    {
        if (null === $this->name && null === $this->file) {
            $context->addViolationAt(
                'name',
                'The picture must be valid',
                array(),
                null
            );
        }
    }

    /**
     * {@inheritdoc}
     *
     * @Serializer\VirtualProperty
     * 
     * @return int
     */
    public function webPath()
    {
        return $this->getWebPicture();
    }

    /**
     * {@inheritdoc}
     */
    public function getAbsolutePicture()
    {
        return null === $this->getName() ? null : $this->getUploadRootDir() . '/' . $this->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getWebPicture()
    {
        return null === $this->getName() ? null : $this->getUploadDir() . '/' . $this->getName();
    }

    /**
     * Get the upload root dir
     *
     * @param string $folderName The folder name
     * @return string
     */
    protected function getUploadRootDir($folderName = null)
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir($folderName);
    }

    /**
     * Get the upload dir
     *
     * @param string $folderName The folder name
     * @return string
     */
    protected function getUploadDir($folderName = null)
    {
        return 'uploads/avatar/pictures' . ($folderName === null ? '' : '/' . $folderName);
    }
}
