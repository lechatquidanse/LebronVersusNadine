<?php

namespace LCQD\AppBundle\Features\Context;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use LCQD\Component\Features\Context\BaseContext;

/**
 * BrowserContext
 * Defines application features from the specific context.
 * 
 * @author lechatquidanse
 */
class BrowserContext extends BaseContext
{
    /**
     * Mink Context
     * @var Behat\MinkExtension\Context\MinkContext
     */
    
    public $minkContext;

    /**
     * routes
     * 
     * @var array
     */
    public $routes = array();

    /** @BeforeScenario */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
        $this->minkContext = $environment->getContext('Behat\MinkExtension\Context\MinkContext');
    }

    /**
     * @Given I am on :pagename page
     */
    public function iAmOnPage($pagename)
    {
        var_dump($this->getRouteFromPagename($pagename));
        $this->minkContext->visit($this->getRouteFromPagename($pagename));
    }
    /**
     * @Then I should be on :pagename page
     */
    public function iShouldBeOnPage($pagename)
    {
        $this->minkContext->assertPageAddress($this->getRouteFromPagename($pagename));
    }

    public function __construct()
    {
        $this->addRoutes();
    }
    
    /**
     * Generate url.
     *
     * @param string  $route
     * @param array   $parameters
     * @param Boolean $absolute
     *
     * @return string
     */
    protected function generateUrl($route, array $parameters = array(), $absolute = false)
    {
        return $this->locatePath($this->getService('router')->generate($route, $parameters, $absolute));
    }

    private function getRouteFromPagename($pagename, array $parameters = array(), $absolute = false)
    {
        if (false === array_key_exists($pagename, $this->routes)) {
            throw new \Exception(sprintf('No route found for page %s', $pagename));
        }

        $routename = $this->routes[$pagename];

        return $this->generateUrl($routename, $parameters, $absolute);
    }

    private function addRoute($pagename, $routename)
    {
        $this->routes[$pagename] = $routename;
    }

    private function addRoutes()
    {
        $userRoutes = array(
            'avatars' => 'api_1_get_avatars',
            'homepage' => 'lcqd_app_homepage',
            'login' => 'fos_user_security_login',
            'registration' => 'fos_user_registration_register',
            'registration confirmed' => 'fos_user_registration_confirmed',
            );

        foreach ($userRoutes as $pagename => $routename) {
            $this->addRoute($pagename, $routename);
        }
    }

    public static function getAcceptedSnippetType()
    {
        return 'regex';
    }
}
