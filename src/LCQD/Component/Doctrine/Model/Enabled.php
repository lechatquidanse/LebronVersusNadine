<?php

/**
 * This file is part of the Component package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LCQD\Component\Doctrine\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enabled
 *
 * Trait Enabled used to add an enabled flag to Entity
 * 
 * @author lechatquidanse
 */
trait Enabled
{
    /**
     * Enable entity
     *
     * @var boolean
     *
     * @ORM\Column(name="enabled",type="boolean", nullable=true)
     */
    protected $enabled = true;

    /**
     * Set the enable value
     *
     * @param boolean $enable The enabled of the entity
     *
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Check if the entity is enabled
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Enable the entity
     *
     * @return $this
     */
    public function enabled()
    {
        $this->enabled = true;

        return $this;
    }

    /**
     * Disable the entity
     *
     * @return $this
     */
    public function disabled()
    {
        $this->enabled = false;

        return $this;
    }

    /**
     * Toggle the enabled of the entity
     *
     * @return $this
     */
    public function toggleEnabled()
    {
        $this->enabled = !$this->enabled;

        return $this;
    }
}
