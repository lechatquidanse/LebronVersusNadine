<?php

namespace LCQD\PlaystationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use LCQD\Component\Doctrine\Model as DoctrineModel;
use LCQD\PlaystationBundle\Model\Avatar as BaseAvatar;

/**
 * Avatar
 *
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="LCQD\PlaystationBundle\Entity\AvatarRepository")
 * @ORM\Table(name="lcqd_avatar")
 * 
 * @Hateoas\Relation(
 *     "self",
 *     href = @Hateoas\Route(
 *          "api_1_get_avatar",
 *          parameters = { 
 *              "id" = "expr(object.getId())",
 *              "_format" = "json"
 *          },
 *          absolute = true
 *     )
 * )
 * 
 * @author lechatquidanse
 */
class Avatar extends BaseAvatar
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
    protected $birthdayAt;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="LCQD\PlaystationBundle\Entity\Picture", mappedBy="avatar", cascade={"all"}, orphanRemoval=true)
     */
    protected $pictures;

    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="LCQD\UserBundle\Entity\User", mappedBy="avatar")
     * @Serializer\Exclude
     */
    protected $users;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

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

    /**
     * setUsers
     * 
     * @param ArrayCollection $users
     * @return Avatar
     */
    public function setUsers(ArrayCollection $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Add a new picture
     *
     * @param Picture $picture The picture
     *
     * @return Avatar
     */
    public function addPicture(Picture $picture)
    {
        $picture->setAvatar($this);
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * Remove a picture
     *
     * @param Picture $picture The picture
     *
     * @return Avatar
     */
    public function removePicture(Picture $picture)
    {
        $this->pictures->removeElement($picture);

        return $this;
    }

    /**
     * Set all pictures
     * 
     * @param ArrayCollection $pictures
     *
     * @return Avatar
     */
    public function setPictures(ArrayCollection $pictures)
    {
        $this->pictures = $pictures;

        return $this;
    }

    /**
     * Get all pictures
     *
     * @return ArrayCollection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * getUsers
     * 
     * @return ArrayCollection|null
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Count Users
     * Return the number of users that use this avatar
     *
     * @Serializer\VirtualProperty
     * 
     * @return int
     */
    public function countUsers()
    {
        return $this->users->count();
    }

    /**
     * Count Pictures
     * Return the number of pictures for this avatar
     *
     * @Serializer\VirtualProperty
     * 
     * @return int
     */
    public function countPictures()
    {
        return $this->pictures->count();
    }
}
