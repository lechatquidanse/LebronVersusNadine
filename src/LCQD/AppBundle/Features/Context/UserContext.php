<?php

namespace LCQD\AppBundle\Features\Context;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use LCQD\Component\Features\Context\BaseContext;

/**
 * UserContext
 * Defines application features from the specific context.
 * 
 * @author lechatquidanse
 */
class UserContext extends BaseContext
{

    private $minkContext;
    private $minkRedirectContext;


    /** @BeforeScenario */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
        //$this->minkContext = $environment->getContext('Behat\MinkExtension\Context\MinkContext');
    }
    /**
     * @When I fill in login form with :options informations
     */
    public function iFillInLoginFormWithInformations($options)
    {
        $this->fillField('username', 'lol');
        $this->fillField('password', 'lol');
    }

    /**
     * @When I fill in register form with :options informations
     */
    public function iFillInFormWithInformations($options)
    {
        $this->fillField('fos_user_registration_form_email', 'zum@zum.zz');
        $this->fillField('fos_user_registration_form_username', 'zum');
        $this->fillField('fos_user_registration_form_plainPassword_first', 'zum');
        $this->fillField('fos_user_registration_form_plainPassword_second', 'zum');
    }

    /**
     * @Then I should see :arg1 information
     */
    public function iShouldSeeInformation($arg1)
    {
        $this->assertSession()->assertPageContainsText('welcome homepage');
    }

    /**
     * @When I submit login form
     */
    public function iSubmitLoginForm()
    {
        $this->pressButton('security.login.submit');
    }

    /**
     * @When I submit register form
     */
    public function iSubmitRegisterForm()
    {
        //$this->minkContext->forward('registration.submit');
    }

    public static function getAcceptedSnippetType()
    {
        return 'regex';
    }
}
