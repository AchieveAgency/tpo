Feature: Client Page management
  In order to manage pages
  As a client_admin user
  I need to be able to manage pages

Scenario: Create and delete a Page
  Given I am logged in as a user with the "client_admin" role
  When I create a Page
  And save it
  Then I should be able to delete it

Scenario: Publish and unpublish a Page
  Given I am logged in as a user with the "client_admin" role
  When I create a Page
  And save it
  Then I should be able to unpublish it

Scenario: Add a Page to a menu
  Given I am logged in as a user with the "client_admin" role
  When I create a Page
  And save it
  Then I should be able to add it to a menu

Scenario: Modify page metatags
  Given I am logged in as a user with the "client_admin" role
  When I create a Page
  And change the metatags title to "test"
  And save it
  Then I should see "test" in the metatags title

Scenario: Modify page path
  Given I am logged in as a user with the "client_admin" role
  When I create a Page
  And change the path to "/test"
  And save it
  Then the path should be "/test"

Scenario: Modify page schedule
  Given I am logged in as a user with the "client_admin" role
  When I create a Page
  And change the schedule publish date to "2020-01-01"
  And change the schedule publish time to "12:00:00"
  And change the schedule unpublish date to "2020-02-01"
  And change the schedule unpublish time to "12:00:00"
  And save it
  Then I should see the schedule publish date is "2020-01-01"
  And I should see the schedule publish time is "12:00:00"
  And I should see the schedule unpublish date is "2020-02-01"
  And I should see the schedule unpublish time is "12:00:00"

Scenario: Add to and view revision log
  Given I am logged in as a user with the "client_admin" role
  When I create a Page
  And add "test" to the revision log
  And save it
  Then I should see the revision log contains "test"
