Feature: addNote
	In order to add a new note
	As a website user
	I need to be loggedin


	Scenario: addNote
		Given I am loggedin
		Given I am on "display/vault"
		Then I shoudl see "fuck off"
		Then I should be on "display/notes"