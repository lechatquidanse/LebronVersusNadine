<?php

namespace LCQD\PlaystationBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use LCQD\PlaystationBundle\Model\Avatar as BaseAvatar;

/**
 * Avatar
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="LCQD\PlaystationBundle\Entity\AvatarRepository")
 * @ORM\Table(name="lcqd_avatar")
 * 
 * @author lechatquidanse
 */
class Avatar extends BaseAvatar
{
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
     * @ORM\Column(name="firstname", type="string", length=45, nullable=false)
     */
    protected $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=45, nullable=true)
     */
    protected $lastname;

    /**
     * @var text
     *
     * @ORM\Column(name="about_me", type="text", nullable=true)
     */
    protected $aboutMe;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_enabled", type="boolean")
     */
    protected $isEnabled = true;

    /**
     * @var Datetime
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="birthday_at", type="datetime", nullable=true)
     */
    private $birthdayAt;

    /**
     * @var Datetime
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var Datetime
     * 
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $firstname
     * @return Avatar
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $lastname
     * @return Avatar
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param boolean $isEnabled
     * @return Avatar
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @param string $aboutMe
     * @return Avatar
     */
    public function setAboutMe($aboutMe)
    {
        $this->aboutMe = $aboutMe;

        return $this;
    }

    /**
     * @return string
     */
    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    /**
     * @param Datetime $birthdayAt
     * @return Avatar
     */
    public function setBirthdayAt(\Datetime $birthdayAt = null)
    {
        $this->birthdayAt = $birthdayAt;

        return $this;
    }

    /**
     * @return Datetime
     */
    public function getBirthdayAt()
    {
        return $this->birthdayAt;
    }

    /**
     * @param Datetime $createdAt
     * @return Avatar
     */
    public function setCreatedAt(\Datetime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param Datetime $updatedAt
     * @return Avatar
     */
    public function setUpdatedAt(\Datetime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
