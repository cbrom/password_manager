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
require_once 'app/core/User.php';
require_once 'app/database.php';

/**
 * Defines application features from the specific context.
 */
class NotesContext extends MinkContext implements SnippetAcceptingContext
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



    public function __construct()
    {
        $this->user = new User;
        $this->folder = new Folder;
        $this->formfill = new FormFill;
        $this->note = new Note;
        $this->site = new Site;
    }


}
