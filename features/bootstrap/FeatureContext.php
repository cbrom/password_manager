<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\SnippetAcceptingContext;


require_once 'app/models/Folder.php';
require_once 'app/models/FormFill.php';
require_once 'app/models/Note.php';
require_once 'app/models/Site.php';
require_once 'app/models/Site.php';
require_once 'app/init.php';


/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    protected $user;
    protected $folder;
    protected $formfill;
    protected $note;
    protected $site;
    protected $password;



    public function __construct()
    {
        $this->user = new User;
        $this->folder = new Folder;
        $this->formfill = new FormFill;
        $this->note = new Note;
        $this->site = new Site;
    }

    /**
     * @Given I have an email :arg1
     */
    public function iHaveAnEmail($arg1)
    {
        $this->user->setEmail($arg1);
    }

    /**
     * @Given I have a password :arg1
     */
    public function iHaveAPassword($arg1)
    {
        $this->user->setPassword($arg1);
        $this->password = $arg1;
    }

    /**
     * @When I signIn
     */
    public function iSignin()
    {
        require_once 'app/controllers/auth_controller.php';
        $controller = new AuthController;

        $controller->signin();
    }

    /**
     * @Given I have a username :arg1
     */
    public function iHaveAUsername($arg1)
    {
        //throw new PendingException();
    }

    /**
     * @Given I have a confirm_password :arg1
     */
    public function iHaveAConfirmPassword($arg1)
    {
        //throw new PendingException();
    }

    /**
     * @When I signUp
     */
    public function iSignup()
    {
        // throw new PendingException();
    }


    /**
     * @Given I am loggedIn
     */
    public function iAmLoggedin()
    {
        User::loginUser("cs@gmail.com", "password");
    }

    /**
     * @Then I should savenote
     */
    public function iShouldSavenote()
    {
        echo $_POST["note"];
    }

    /**
     * @Given I click the :arg1 element
     */
    public function iClickTheElement($arg1)
    {
        $page = $this->getSession()->getPage();
        //var_dump($page);
        $element = $page->find('xpath', $this->getSession()->getSelectorsHandler()->selectorToXpath('xpath', '*//*[text()="' . $arg1 . '"]'));

        if (empty($element))
        {
            throw new Exception("No html element found");
        }

        $element->click();
    }
}
