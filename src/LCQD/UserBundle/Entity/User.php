<?php

namespace LCQD\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hateoas\Configuration\Annotation as Hateoas;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use LCQD\PlaystationBundle\Model\AvatarInterface as AvatarInterface;
use LCQD\UserBundle\Model\User as BaseUser;

/**
 * User
 * 
 * @ORM\Entity
 * @ORM\Table(name="lcqd_user")
 *
 * @Hateoas\Relation(
 *     "self",
 *     href = @Hateoas\Route(
 *          "api_1_get_me",
 *          parameters = { "_format" = "json" },
 *          absolute = true
 *     )
 * )
 * 
 * @author lechatquidanse
 */
class User extends BaseUser
{
    use ORMBehaviors\Timestampable\Timestampable;
    
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
