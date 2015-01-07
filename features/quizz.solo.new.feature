@database @avatar @quizz
Feature: Start Solo Quizz Game
  In order to decide what kind of quizz fun I want when I do not have friend
  As a user
  I need to be able to select a level to start quizz game

  Rules:
    - User has to have an avatar
    - User has select quizz game
    - User has to select a level (2 levels available)

  Background:
    Given I am logged in

  Scenario: User has no avatar
    Given I am on "homepage" page
    And I do not have an avatar
    When I go "game" page
    Then I should be redirected to "avatar" page
    And I should see "mandatory-avatar" message

  Scenario: User has an avatar
    Given I am on "homepage" page
    When I go "game" page
    Then I should see "quizz" game "select" option

  Scenario: User has selected the quizz game
    Given I am on "game" page
    When I select "quizz" game
    Then I should see "quizz" game "level" option

  Scenario: User hasn't selected the quizz game
    Given I am on "game" page
    When I do not select "quizz" game
    Then I should not see "quizz" game "level" option

  Scenario: User has selected a level of quizz game
    Given I am on "game" page
    When I select "quizz" game
    And I select level "1" of "quizz" game
    Then I should see "quizz" game "play" option

  Scenario: User hasn't selected a level of quizz game
    Given I am on "game" page
    When I select "quizz" game
    And I do not select level "1" of "quizz" game
    Then I should not see "quizz" game "play" option
