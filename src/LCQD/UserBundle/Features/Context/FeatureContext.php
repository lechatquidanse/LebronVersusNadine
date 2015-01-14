<?php

namespace LCQD\UserBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * 
     */
    use KernelDictionary;

    private $minkContext;
    private $minkRedirectContext;

    /** @BeforeScenario */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
    
        $this->minkRedirectContext = $environment->getContext('LCQD\UserBundle\Features\Context\MinkRedirectContext');
        $this->minkContext = $environment->getContext('Behat\MinkExtension\Context\MinkContext');
    }

    protected function getPathFromPagename($pagename)
    {
        $router = $this->getContainer()->get('router');

        switch ($pagename) {

            case 'registration':
                $routename = 'fos_user_registration_register';
                break;
            case 'registration confirmed':
                $routename = 'fos_user_registration_confirmed';
                break;

            default:
                # code...
                break;
        }

        $url = $router->generate($routename);

        return $url;
    }

    /**
     * @Given I am on :pagename page
     */
    public function iAmOnPage($pagename)
    {
        $url = $this->getPathFromPagename($pagename);
        $this->minkContext->visitPath($url);
    }

    /**
     * @When I fill in :formname form with :arg2 informations
     */
    public function iFillInFormWithInformations($formname, $arg2)
    {
        $this->minkContext->fillField('fos_user_registration_form_email', 'zum@zum.zz');
        $this->minkContext->fillField('fos_user_registration_form_username', 'zum');
        $this->minkContext->fillField('fos_user_registration_form_plainPassword_first', 'zum');
        $this->minkContext->fillField('fos_user_registration_form_plainPassword_second', 'zum');
    }

    /**
     * @Then I should be redirected to :pagename page
     */
    public function iShouldBeRedirectedToPage($pagename)
    {
        $url = $this->getPathFromPagename($pagename);
        $this->minkRedirectContext->iAmRedirected($url);
    }

    /**
     * @Then I should see :arg1 information
     */
    public function iShouldSeeInformation($arg1)
    {
        $this->minkContext->assertPageContainsText('registration.confirmed');
    }

    /**
     * @When I submit :formname form
     */
    public function iSubmitForm($formname)
    {
        $this->minkContext->forward('registration.submit');
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
