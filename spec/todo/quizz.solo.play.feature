# @database @avatar @quizz @solo
# Feature: Play Solo Quizz Game
#   In order to have fun when I do not have friend
#   As a user
#   I need to be able to answer questions and use my avatar skills

#   Rules:
#     - User has to have an avatar
#     - A quizz is composed by 10 questions on different categories
#     - For each question, 4 answers is proposed by default for level 2
#     - For each question, 2 answers is proposed by default for level 1
#     - For each question, if the question category is the same of the avatar, then the answer proposed is divided by 2
#     - For each question, user has 10 secondes to select his answer
#     - For each good answer, user score is incremented
#     - At the end, User can see how many credits he has won

#   Background:
#     Given I am logged in
#     And I select "quizz" game
#     And I select level 2 of "quizz" game

#   Scenario: User is answering first question in time with good answer
#     Given I read first question of "quizz" game
#     When I select "good" answer of "quizz" game before buzzer
#     Then I should next question of "quizz" game
#     And I should see "quizz" game "good" answer
#     And I should see my score increments

#   Scenario: User is answering first question in time with bad answer
#     Given I read first question of "quizz" game
#     When I select "bad" answer of "quizz" game before buzzer
#     Then I should end game of "quizz" game
#     And I should see "quizz" game "bad" answer
#     And I should see my score stay the same

#   Scenario: User is answering last question in time with good answer
#     Given I read last question of "quizz" game
#     When I select "good" answer of "quizz" game before buzzer
#     Then I should end game of "quizz" game
#     And I should see "quizz" game "good" answer
#     And I should see my score increments
#     And I should have answered 10 questions

#   Scenario: User is not answering first question
#     Given I read first question of "quizz" game
#     When I do not select answer of "quizz" game
#     Then I should next question of "quizz" game
#     And I should see "quizz" game "late" answer
#     And I should see my score stay the same

#   Scenario: User sees a question that match his avatar category
#     Given my avatar category is "sports"
#     And question category of "quizz" game is "sports"
#     When I read first question of "quizz" game
#     Then I should see 2 answers

#   Scenario: User sees a question that does not match his avatar category
#     Given my avatar category is "sports"
#     And question category of "quizz" game is "art"
#     When I read first question of "quizz" game
#     Then I should see 4 answers

#   Scenario: User funds has been increased