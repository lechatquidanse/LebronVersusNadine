<?php

/**
 * This file is part of the Component package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LCQD\Component\Features\Context;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Exception;

/**
 * BaseContext
 *
 * Abstract Base context for common behaviour context
 * 
 * @author lechatquidanse
 */
abstract class BaseContext extends RawMinkContext implements Context, KernelAwareContext, SnippetAcceptingContext
{
    use KernelDictionary;
       
    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    protected function getService($id)
    {
        return $this->getContainer()->get($id);
    }
    
    /**
     * Get current user instance.
     *
     * @return null|UserInterface
     *
     * @throws Exception
     */
    protected function getUser()
    {
        $token = $this->getSecurityContext()->getToken();
        if (null === $token) {
            throw new Exception('No token found in security context.');
        }
        return $token->getUser();
    }
    
    /**
     * Get security context.
     *
     * @return SecurityContextInterface
     */
    protected function getSecurityContext()
    {
        return $this->getContainer()->get('security.context');
    }
    
    /**
     * Press Button
     *
     * Presses button with specified id|name|title|alt|value.
     *
     * @param string $button
     */
    protected function pressButton($button)
    {
        $this->getSession()->getPage()->pressButton($this->fixStepArgument($button));
    }
    
    /**
     * CLick Link
     * 
     * Clicks link with specified id|title|alt|text.
     *
     * @param  string $link
     */
    protected function clickLink($link)
    {
        $this->getSession()->getPage()->clickLink($this->fixStepArgument($link));
    }

    /**
     * Fill Field
     * 
     * Fills in form field with specified id|name|label|value.
     *
     * @param string $field
     * @param string $value
     */
    protected function fillField($field, $value)
    {
        $this->getSession()->getPage()->fillField($this->fixStepArgument($field), $this->fixStepArgument($value));
    }

    /**
     * Check Fields
     * 
     * Checks checkbox with specified id|name|label|value.
     *
     * @param string $field
     */
    protected function checkField($field)
    {
        $this->getSession()->getPage()->checkField($this->fixStepArgument($field));
    }
    
    /**
     * Select Optin
     * 
     * Selects option in select field with specified id|name|label|value.
     *
     * @param string $select
     * @param string $option
     */
    protected function selectOption($select, $option)
    {
        $this->getSession()->getPage()->selectFieldOption($this->fixStepArgument($select), $this->fixStepArgument($option));
    }
    
    /**
     * Fix Step Argument
     * 
     * Returns fixed step argument (with \\" replaced back to ").
     *
     * @param string $argument
     * @return string
     */
    protected function fixStepArgument($argument)
    {
        return str_replace('\\"', '"', $argument);
    }
}
