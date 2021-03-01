Feature: SignInSignUp
	In order to sign in into password manager
	As a website user
	I need to be able to view the homepage

	Scenario: sign in and sign up
		Given I am on "/auth/signin"
    	Then I should see "HOME"

	Scenario: sign in
		Given I am on "/auth/signin"
		When I fill in "email" with "cs@gmail.com"
		When I fill in "password" with "password"
		And I press "btn-login"
		Then I signIn
		Then I should be on "/display/vault"
		Then I should see "REPOSITORY"
