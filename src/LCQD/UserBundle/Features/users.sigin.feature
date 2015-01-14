Feature: User sign in application
  In order to use the application as me and save data
  As a user
  I need to be able to register and login

  @javascript
  Scenario: Successful "login" with "application account"
    Given I am on "login" page
    When I fill in login form with "good" informations
    And I submit login form
    Then I should be on "homepage" page
    And I should see "successful login" information

  #@javascript
  #Scenario: Successful "registration" with "application account"
  #  Given I am on "registration" page
  #  When I fill in register form with "successful" informations
  #  And I submit register form
  #  Then I should be redirected to "registration confirmed" page
  #  And I should see "successful registration" informations