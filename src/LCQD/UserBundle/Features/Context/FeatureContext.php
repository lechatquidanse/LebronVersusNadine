<?php

namespace LCQD\UserBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Definition\Call\Given;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    /**
     * 
     */
    use KernelDictionary;

    /**
     * @Given I am on :pagename page
     */
    public function iAmOnPage($pagename)
    {
        $router = $this->getContainer()->get('router');

        switch ($pagename) {

            case 'registration':
                $routename = 'fos_user_registration_register';
                break;
            
            default:
                # code...
                break;
        }

        $url = $router->generate('fos_user_registration_register');

        $this->visit($url);
    }

    /**
     * @When I fill in :formname form with :arg2 informations
     */
    public function iFillInFormWithInformations($formname, $arg2)
    {
        $this->fillField('fos_user_registration_form_email', 'zum@zum.zz');
        $this->fillField('fos_user_registration_form_username', 'zum');
        $this->fillField('fos_user_registration_form_plainPassword_first', 'zum');
        $this->fillField('fos_user_registration_form_plainPassword_second', 'zum');
    }

    /**
     * @When I submit :formname form
     */
    public function iSubmitForm($formname)
    {
        $this->clickLink('submit');
    }

    /**
     * @Then I should be redirected to :arg1 page
     */
    public function iShouldBeRedirectedToPage($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see :arg1 information
     */
    public function iShouldSeeInformation($arg1)
    {
        throw new PendingException();
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
}
