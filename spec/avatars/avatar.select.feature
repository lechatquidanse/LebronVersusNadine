@database @avatar
Feature: User selects an Avatar 
  In order to improve my game skills
  As a user
  I need to be able to select or purchase an avatar

  Background:
        Given there are following users in database:
            | email | username | password |
            | mishka@lebronvsnadine.dev | Mishka | password |

  @javascript
  Scenario: User want to see his funds
  	Given I am authentificated as "Mishka"
  	And my funds are "250"
  	When I am on "avatars" page
  	Then I should see "250"

  # Scenario: User has a choice of 10 avatar
  # Scenario: User look at a avatar informations
  # Scenario: User make active a purchased avatar
  # Scenario: User make active a not purchased avatar

  # Scenario: User has sufficient funds to purchase a new avatar
  #   Given I am on "avatars" page
  #   And my funds are "200"
  #   When I purchase a avatar that worths "150"
  #   Then my account balance should be "50"
  #   And I should see avatar as my selected avatar
  #   And I should see "successful purchase" information

  # Scenario: User has insufficient funds to purchase a new avatar
  #   Given I am on "avatars" page
  #   And my account balance is "10"
  #   When I purchase a avatar that worths "60"
  #   Then I should see "error purchase" information
  #   And I should not see avatar as my selected avatar
  