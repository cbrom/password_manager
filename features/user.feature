Feature: SignInSignUp
	In order to sign in into password manager
	As a website user
	I need to be able to view the homepage

	Scenario: sign in and sign up
		Given I am on "/auth/signin"
    	Then I should see "PSD MGR"

    	Scenario: sign in
			Given I am on "/auth/signin"
			And I have an email "cs@gmail.com"
			And I have a password "password"
			When I signIn
			Then I should be on "/"

		Scenario: sign up
			Given I am on "/auth/signup"
			And I have a username "Test User name"
			And I have an email "test@gmail.com"
			And I have a password "newpassword"
			And I have a confirm_password "newpassword"
			When I signUp
			Then I should be on "/"