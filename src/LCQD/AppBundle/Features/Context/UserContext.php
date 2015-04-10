<?php

/**
 * This file is part of the App package.
 *
 * (c) lechatquidanse
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LCQD\AppBundle\Features\Context;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\TableNode;
use LCQD\AppBundle\Features\Context\AppContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * UserContext
 * 
 * Defines application features from the specific context.
 * 
 * @author lechatquidanse
 * @todo Fix mink catch redirection
 */
class UserContext extends AppContext
{
    private $browserContext;
    
    /** @BeforeScenario */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();
        $this->browserContext = $environment->getContext('LCQD\AppBundle\Features\Context\BrowserContext');
    }

    /**
     * Users
     *
     * Array of users informations created for feature
     * 
     * @var array
     */
    private $users = array();

    /**
     * There are following users in database
     *
     * Persist and flush user in $table
     * 
     * @Given there are following users in database:
     * 
     * @param  TableNode $table
     */
    public function thereAreFollowingUsersInDataBase(TableNode $table)
    {
        foreach ($table->gethash() as $row) {
            $this->users[$row['username']] = $row;

            $user = $this->userManager->createUser();
            $user->setUsername($row['username']);
            $user->setEmail($row['email']);
            $user->setPlainPassword($row['password']);
            $user->setEnabled(true);

            $avatar = $this->avatarManager->getOneRandom();
            $user->setAvatar($avatar);

            $this->userManager->updateUser($user);
        }
    }

    /**
     * I am authentificated as
     * 
     * @Given I am authentificated as :username
     * 
     * @param  string $username
     * @throws Exception If no user
     */
    public function iAmAuthentificatedAs($username)
    {
        if (!isset($this->users[$username]['password'])) {
            throw new \Exception('Invalid user ' . $username);
        }

        $user = $this->userManager->findUserBy(array('username' => $this->users[$username]));

        if (!$user) {
            throw new \Exception('No user ' . $username);
        }

        $this->browserContext->iAmOnPage('login');
        $this->iFillInLoginFormWithLoginAndPassword($username, $this->users[$username]['password']);
        $this->iSubmitLoginForm();
    }

    /**
     * @Given my funds are :funds
     */
    public function myFundsAre($funds)
    {
        $user = $this->getAppUser();
        $user->setFunds($funds);
        $this->userManager->updateUser($user);
    }

    /**
     * @When I fill in login form with login :login and password :password
     */
    public function iFillInLoginFormWithLoginAndPassword($login, $password)
    {
        $this->fillField('username', $login);
        $this->fillField('password', $password);
    }

    /**
     * @When I submit login form
     */
    public function iSubmitLoginForm()
    {
        $this->pressButton('security.login.submit');
    }

    /**
     * @When I fill in registration form with successful informations
     */
    public function iFillInRegistrationFormWithSuccessfulInformations()
    {
        $email = 'zumzumzum@hotmail.com';
        $username = 'zum';
        $password = 'password';

        $this->fillField('fos_user_registration_form_email', $email);
        $this->fillField('fos_user_registration_form_username', $username);
        $this->fillField('fos_user_registration_form_plainPassword_first', $password);
        $this->fillField('fos_user_registration_form_plainPassword_second', $password);
    }

    /**
     * @When I submit registration form
     */
    public function iSubmitRegistrationForm()
    {
        //$this->minkContext->forward('registration.submit');
    }

    public static function getAcceptedSnippetType()
    {
        return 'regex';
    }
}
