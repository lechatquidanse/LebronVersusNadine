<?php

namespace LCQD\UserBundle\Entity;

use LCQD\PlaystationBundle\Model\AvatarInterface as AvatarInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="lcqd_user")
 */
class User extends BaseUser
{
    /**
     * @var integer
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\ManyToOne(targetEntity="LCQD\PlaystationBundle\Entity\Avatar", cascade={"persist"})
    * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id", nullable=true)
    */
    private $avatar;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param AvatarInterface $avatar
     * @return User
     */
    public function setAvatar(AvatarInterface $avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return AvatarInterface
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}
