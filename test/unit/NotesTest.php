<?php
use PHPUnit\Framework\TestCase;
require_once 'app/models/Note.php';
require_once 'app/Exceptions/Exceptions.php';
require_once 'app/core/Validate.php';
require_once 'app/database.php';

class NotesTest extends TestCase
{
    protected $note = NULL;
    protected $id = NULL;

    public function setUp()
    {
        $this->note = new Note;
    }

/* =========================================  Unit tests =========================================*/

/* ----------------------------------------- getter and setter tests ----------------------------*/

    public function testGetSetTitle()
    {
        $this->note->setTitle("Title");
        $this->assertEquals($this->note->getTitle(), "Title");
    }

    public function testGetSetContent()
    {
        $content = "This is a content";
        $this->note->setContent($content);
        $this->assertEquals($this->note->getContent(), $content);
    }

    public function testGetSetUserId()
    {
        $user_id = 10;
        $this->note->setUserId($user_id);
        $this->assertEquals($this->note->getUserId(), $user_id);
    }

/* ---------------------------------------- Domain tests ---------------------------------*/

    /* ------------------------ notes user_id-------------------*/

    /** @test */
    public function test_negative_user_id_exception()
    {
        $this->expectException(NegativeUserIdException::class);
        $this->note->setUserId(-10);
    }

    /** @test */
    public function test_empty_user_id_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->note->setUserId();
    }

    /** @test */
    public function test_user_id_above_limit_exception()
    {
        $this->expectException(AboveLimitException::class);
        $this->note->setUserId(1000000000000);
    }

    /** @test */
    public function test_string_input()
    {
        $this->note->setUserId("20");
        $this->assertEquals($this->note->getUserId(), 20);
    }

    /** @test */
    public function test_set_mixed_string()
    {
        $this->note->setUserId("w20s");
        $this->assertEquals($this->note->getUserId(), 20);
    }

    /* ------------------------ notes content-------------------*/

    /** @test */
    public function test_empty_content_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->note->setContent();
    }

    /** @test */
    public function test_content_is_trimmed()
    {
        $content = "  ksjdfl lskdjf l    ";
        $expected = trim($content);
        $this->note->setContent($content);
        $this->assertEquals($this->note->getContent(), $expected);
    }

    /* ------------------------ notes title-------------------*/

    /** @test */
    public function test_empty_title_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->note->setTitle();
    }

    /** @test */
    public function test_title_is_trimmed()
    {
        $title = "lksjdfl lskdjf l    ";
        $expected = ucfirst(trim($title));
        $this->note->setTitle($title);
        $this->assertEquals($this->note->getTitle(), $expected);
    }

    /** @test */
    public function test_title_above_limit_exception()
    {
        $title = "aaaaa-bbbbb-ccccc-ddddd-eeeee-fffff-ggggg";
        $this->expectException(AboveLimitException::class);
        $this->note->setTitle($title);
    }

    /** @test */
    public function test_title_captalized()
    {
        $title = "dlskjf";
        $expected = ucfirst(trim($title));
        $this->note->setTitle($title);
        $this->assertEquals($this->note->getTitle(), $expected);
    }

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