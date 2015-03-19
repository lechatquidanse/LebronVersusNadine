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
    * @ORM\OneToMany(targetEntity="LCQD\UserBundle\Entity\User", mappedBy="avatar")
    * @Serializer\Exclude
    */
    private $users;

    /**
     * __construct
     */
    public function __construct()
    {
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
     * getUsers
     * 
     * @return ArrayCollection|null
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * countUsers
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
}
