<?php

namespace LCQD\AppBundle\Doctrine;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;
use Knp\DoctrineBehaviors\Reflection\ClassAnalyzer;

/**
 * EnabledFilter
 * 
 * @author lechatquidanse
 */
class EnabledFilter extends SQLFilter
{
    /**
     * $classAnalyzer
     * 
     * @var ClassAnalyzer
     */
    protected $classAnalyzer;

    /**
     * Gets the SQL query part to add to a query.
     * 
     * @param ClassMetaData $targetEntity
     * @param string $targetTableAlias
     *
     * @return string The constraint SQL if there is available, empty string otherwise.
     */
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        if (!$this->classAnalyzer) {
            return '';
        }

        // If reflectionClass use trait LCQD\Component\Doctrine\Model\Enabled then add filter
        if ($this->classAnalyzer->hasTrait($targetEntity->getReflectionClass(), 'LCQD\Component\Doctrine\Model\Enabled')) {
            return sprintf('%s.enabled = %s', $targetTableAlias, $this->getParameter('enabled'));
        }

        return '';
    }

    /**
     * setClassAnalyzer
     * 
     * @param ClassAnalyzer $classAnalyzer
     */
    public function setClassAnalyzer(ClassAnalyzer $classAnalyzer)
    {
        $this->classAnalyzer = $classAnalyzer;

        return $this;
    }
}
