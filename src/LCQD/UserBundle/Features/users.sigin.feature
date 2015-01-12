Feature: User sign in application
  In order to use the application as me and save data
  As a user
  I need to be able to register and login

  @javascript
  Scenario: Successful "registration" with "application account"
    Given I am on "registration" page
    When I fill in "creating an account" form with "successful" informations
    And I submit "creating an account" form
    Then I should be redirected to "my account" page
    And I should see "successful registration" information