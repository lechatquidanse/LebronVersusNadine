Feature: User sign in application
  In order to use the application as me and save data
  As a user
  I need to be able to register and login

  Background:
    Given there are following users in database:
        | email | username | password |
        | mishka@lebronvsnadine.dev | Mishka | password |

  # Scenario: Successful "registration" with "application account"
  #   Given I am on "registration" page
  #   When I fill in registration form with successful informations
  #   And I submit registration form
  #   Then I should be redirected to "my account" page
  #   And I should see "successful registration" information

  # Scenario: Filled Email is already used
  #   Given I am on "registration" page
  #   And A user has already been registered with "already@exists.fr" email
  #   When I fill "creating an account" form with "already exist mail" information
  #   And I submit "creating an account" form
  #   Then I should be redirected to "registration" page
  #   And I should see "already exist mail" information

  Scenario: Successful "log in" with "application account"
    Given I am on "log in" page
    When I fill "log in" form with login "Mishka" and password "password"
    And I submit "log in" form
    Then I should be redirected to "my account" page
    And I should see "successful log in" information

  # Scenario: Error "log in" with "application account"
  #   Given I am on "log in" page
  #   When I fill "log in" form with "error" information
  #   And I submit "log in" form
  #   Then I should be redirected to "log in" page
  #   And I should see "error log in" information

  # Scenario: Successful "registration" with "facebook"
  #   Given I am on "registration" page
  #   When I am registering with "facebook" account
  #   Then I should be redirected to "my account" page
  #   And I should see "successful registration" information

  # Scenario: Successful "registration" with "twitter"
  #   Given I am on "registration" page
  #   When I am registering with "twitter" account
  #   Then I should be redirected to "my account" page
  #   And I should see "successful registration" information
    
  # Scenario: Successful "registration" with "github"
  #   Given I am on "registration" page
  #   When I am registering with "github" account
  #   Then I should be redirected to "my account" page
  #   And I should see "successful registration" information