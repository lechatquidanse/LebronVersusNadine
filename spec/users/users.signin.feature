@database @user
Feature: User sign in application
  In order to use the application as me and save data
  As a user
  I need to be able to register and login

  @registration_success
  Scenario: Successful "registration" with "application account"
    Given I am on "registration" page
    When I fill in registration form with login "Mishka_2" and email "mishka_2@lebronvsnadine.dev " and password "password" and password_confirmation "password"
    And I submit registration form
    Then I should be on "registration confirmed" page
    And I should see "registration.confirmed"

  @registration_fail_email
  Scenario: Filled Email is already used
    Given there are following users in database:
        | email | username | password |
        | mishka@lebronvsnadine.dev | Mishka | password |
    And I am on "registration" page
    When I fill in registration form with login "MishkaExists" and email "mishka@lebronvsnadine.dev " and password "password" and password_confirmation "password"
    And I submit registration form
    Then I should be on "registration" page
    And I should see "fos_user.email.already_used"

  @registration_fail_login
  Scenario: Filled Email is already used
    Given there are following users in database:
        | email | username | password |
        | mishka@lebronvsnadine.dev | Mishka | password |
    And I am on "registration" page
    When I fill in registration form with login "Mishka" and email "mishka_2@lebronvsnadine.dev " and password "password" and password_confirmation "password"
    And I submit registration form
    Then I should be on "registration" page
    And I should see "fos_user.username.already_used"

  @registration_fail_password_confirmation
  Scenario: Filled Email is already used
    Given I am on "registration" page
    When I fill in registration form with login "Mishka" and email "mishka@lebronvsnadine.dev " and password "password" and password_confirmation "passwordWrong"
    And I submit registration form
    Then I should be on "registration" page
    And I should see "fos_user.password.mismatch"

  @login_success
  Scenario: Successful "log in" with "application account"
    Given there are following users in database:
        | email | username | password |
        | mishka@lebronvsnadine.dev | Mishka | password |
    And I am on "login" page
    When I fill in login form with login "Mishka" and password "password"
    And I submit login form
    Then I should be on "homepage" page
    And I should see "Hello Mishka"

  @login_error
  Scenario: Error "log in" with "application account"
    Given there are following users in database:
        | email | username | password |
        | mishka@lebronvsnadine.dev | Mishka | password |
    And I am on "login" page
    When I fill in login form with login "Mishka" and password "passwordWrong"
    And I submit login form
    Then I should be on "login" page
    And I should see "Invalid credentials."
