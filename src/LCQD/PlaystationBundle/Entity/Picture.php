<?php

namespace LCQD\PlaystationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use LCQD\Component\Doctrine\Model as DoctrineModel;
use LCQD\PlaystationBundle\Model\Picture as BasePicture;
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
class Picture extends BasePicture
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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * 
     * @Serializer\Exclude
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="caption", type="string", length=255, nullable=true)
     */
    private $caption;

    /**
     * @var array
     *
     * @ORM\ManyToOne(targetEntity="LCQD\PlaystationBundle\Entity\Avatar", inversedBy="pictures")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id")
     */
    private $avatar;

    /**
     * @Assert\Image()
     */
    private $file;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Picture
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set caption
     *
     * @param string $caption
     *
     * @return Picture
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Get caption
     *
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set the avatar
     *
     * @param AvatarInterface $avatar The avatar
     *
     * @return Picture
     */
    public function setAvatar(Avatar $avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get the avatar
     *
     * @return AvatarInterface
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the file
     *
     * @param File $file The file
     *
     * @return Widget
     */
    public function setFile(File $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get the file
     *
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Make the filename
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
     * Upload the file
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
     * Remove the file
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
     * Check if the picture is valid.
     *
     * The picture is valid if the name is not null or the name is null and the
     * file is not null
     *
     * @param ExecutionContextInterface $context The validator context
     *
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
     * Web path
     * Return the web path
     *
     * @Serializer\VirtualProperty
     * 
     * @return int
     */
    public function webPath()
    {
        return $this->getWebPicture();
    }
}
