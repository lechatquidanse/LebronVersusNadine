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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use LCQD\Component\Doctrine\Model as DoctrineModel;
use LCQD\PlaystationBundle\Model\AvatarInterface;
use LCQD\PlaystationBundle\Model\PictureInterface;

/**
 * Entity that extends {@inheritdoc} 
 *
 * {@inheritdoc} 
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
class Avatar implements AvatarInterface
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
     * Firstname
     * 
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=45, nullable=false)
     */
    protected $firstname;

    /**
     * Lastname
     * 
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=45, nullable=true)
     */
    protected $lastname;

    /**
     * About me (avatar)
     * 
     * @var text
     *
     * @ORM\Column(name="about_me", type="text", nullable=true)
     */
    protected $aboutMe;

    /**
     * Birthday at
     * 
     * @var Datetime
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="birthday_at", type="datetime", nullable=true)
     */
    protected $birthdayAt;

    /**
     * Price
     * 
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    protected $price;

    /**
     * Pictures
     * 
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="LCQD\PlaystationBundle\Entity\Picture", mappedBy="avatar", cascade={"all"}, orphanRemoval=true)
     */
    protected $pictures;

    /**
     * Users
     * 
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="LCQD\PlaystationBundle\Entity\User", mappedBy="avatar")
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
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     * 
     * @param string $firstname
     * @return Avatar
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * {@inheritdoc}
     * 
     * @param string $lastname
     * @return Avatar
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * {@inheritdoc}
     * 
     * @param string $aboutMe
     * @return Avatar
     */
    public function setAboutMe($aboutMe)
    {
        $this->aboutMe = $aboutMe;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    /**
     * {@inheritdoc}
     * 
     * @param Datetime $birthdayAt
     * @return Avatar
     */
    public function setBirthdayAt(\Datetime $birthdayAt = null)
    {
        $this->birthdayAt = $birthdayAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getBirthdayAt()
    {
        return $this->birthdayAt;
    }

    /**
     * {@inheritdoc}
     * 
     * @param float $price
     * @return Avatar
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
     *
     * @param PictureInterface $picture The picture
     * @return Avatar
     */
    public function addPicture(PictureInterface $picture)
    {
        $picture->setAvatar($this);
        $this->pictures[] = $picture;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @param PictureInterface $picture The picture
     * @return Avatar
     */
    public function removePicture(PictureInterface $picture)
    {
        $this->pictures->removeElement($picture);

        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @param ArrayCollection $pictures
     * @return Avatar
     */
    public function setPictures(ArrayCollection $pictures)
    {
        $this->pictures = $pictures;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
