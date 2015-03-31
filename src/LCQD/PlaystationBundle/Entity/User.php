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
use FOS\UserBundle\Model\User as BaseUser;
use Hateoas\Configuration\Annotation as Hateoas;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use LCQD\PlaystationBundle\Model\UserInterface;
use LCQD\PlaystationBundle\Model\AvatarInterface;
use InvalidArgumentException;
use Exception;

/**
 * User
 * 
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="LCQD\PlaystationBundle\Entity\UserRepository")
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
class User extends BaseUser implements UserInterface
{
    /**
     * Role Api User name
     */
    const __ROLE_API_USER__ = 'ROLE_API_USER';
    
    /**
     * Default funds for User
     */
    const __DEFAULT_FUNDS__ = 100.00;

    /**
     * Add properties, created and updated datetime informations
     */
    use ORMBehaviors\Timestampable\Timestampable;
    
    /**
     * Id
     * 
     * @var integer
     * 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Funds
     *
     * @var float
     *
     * @ORM\Column(name="funds", type="float", nullable=true)
     */
    protected $funds;

    /**
     * Avatar
     *
     * @var Avatar
     * 
     * @ORM\ManyToOne(targetEntity="LCQD\PlaystationBundle\Entity\Avatar", cascade={"persist"}, inversedBy="users")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id", nullable=true)
     */
    private $avatar;

    /**
     * __construct
     * Set Default Roles for User and call parent
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultRoles();
    }

    /**
     * {@inheritdoc}
     *
     * @param float $funds
     * @return User
     */
    public function setFunds($funds)
    {
        $this->funds = $funds;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunds()
    {
        return $this->funds;
    }

    /**
     * {@inheritdoc}
     *
     * @param AvatarInterface $avatar
     * @return User
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
     */
    public function setDefaultFunds()
    {
        $this->setFunds(self::__DEFAULT_FUNDS__);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultRoles()
    {
        return array(self::__ROLE_API_USER__);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultRoles()
    {
        $this->setRoles($this->getDefaultRoles());
    }

    /**
     * {@inheritdoc}
     * 
     * @param  AvatarInterface $avatar
     * @return boolean
     */
    public function hasFundsToBuyAvatar(AvatarInterface $avatar)
    {
        if ($avatar->getPrice() <= $this->getFunds()) {
            return true;
        }

        return false;
    }

    /**
     * Buy Avatar
     * 
     * @param  AvatarInterface $avatar
     * @throws InvalidArgumentException If avatar is not enabled
     * @throws Exception If avatar is already used by User, too expensive, or other
     * @return boolean
     */
    public function buyAvatar(AvatarInterface $avatar)
    {
        if (!$avatar->isEnabled()) {
            throw new InvalidArgumentException(sprintf("Buy Avatar, avatar %d is not enabled", $avatar->getId()), 1);
        }

        if ($this->getAvatar() == $avatar) {
            throw new Exception(sprintf("Buy Avatar, avatar %d is already used by User", $avatar->getId()), 1);
        }

        if (!$this->hasFundsToBuyAvatar($avatar)) {
            throw new Exception(sprintf("Buy Avatar, avatar %d is too expensive for User", $avatar->getId()), 1);
        }

        if (!$this->setAvatar($avatar)) {
            throw new Exception(sprintf("Buy Avatar, avatar %d is too expensive for User", $avatar->getId()), 1);
        }

        return true;
    }
}
