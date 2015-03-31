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
use LCQD\PlaystationBundle\Model\Avatar;
use LCQD\PlaystationBundle\Model\UserInterface;

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
     * @param Avatar $avatar
     * @return User
     */
    public function setAvatar(Avatar $avatar)
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
}
