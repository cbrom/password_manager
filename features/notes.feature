Feature: addNote
	In order to add a new note
	As a website user
	I need to be logged in

	Scenario: add new note	
		Given I am on "/display/notes"
		Then I should see "New Note"
		When I fill in "noteTitle" with "noteTitle"
		When I fill in "note" with "test new note"
		And I press "Save Note"
		Then I should savenote