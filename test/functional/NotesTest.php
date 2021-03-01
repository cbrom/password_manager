<?php
use PHPUnit\Framework\TestCase;
require_once 'app/models/Note.php';
require_once 'app/Exceptions/Exceptions.php';
require_once 'app/core/Validate.php';
require_once 'app/database.php';

class NotesFunctionalTest extends TestCase
{
    protected $note = NULL;
    protected $id = NULL;

    public function setUp()
    {
        $this->note = new Note;
    }

/* =========================================  Unit tests =========================================*/

/* ======================================== Functionality tests ========================*/

        /*----------------------------add note -----------------------*/
        /** @test */
        public function test_a_new_note_is_added_and_deleted()
        {
            $this->note->setUserId(15);
            $this->note->setTitle("Test Note");
            $this->note->setContent("This is a content of test note");
            $response = $this->note->addNote();

            $this->id = $this->note->id;
            $this->assertTrue($response);

            $this->note->deleteNote();
            $this->assertNull(Note::find($this->id));
        }

        /** @test */
        public function test_note_is_edited()
        {
            $new_title = "New Test Title";
            $new_content = "note new test content";
            $this->note = Note::find(3);
            $this->note->setTitle($new_title);
            $this->note->setContent($new_content);
            $this->note->editNote();

            $this->note = Note::find(3);
            $this->assertEquals($this->note->getTitle(), $new_title);
            $this->assertEquals($this->note->getContent(), $new_content);
        }
}
?>