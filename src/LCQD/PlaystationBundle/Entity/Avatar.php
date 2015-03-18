<?php

namespace LCQD\PlaystationBundle\Entity;

use LCQD\Component\Doctrine\Model as DoctrineModel;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
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
    use ORMBehaviors\Timestampable\Timestampable;
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
     * @var Datetime
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="birthday_at", type="datetime", nullable=true)
     */
    private $birthdayAt;

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
}
