<?php
use PHPUnit\Framework\TestCase;
require_once 'app/models/Site.php';
require_once 'app/Exceptions/Exceptions.php';
require_once 'app/core/Validate.php';

class SitesTest extends TestCase
{
    protected $site = NULL;

    public function setUp()
    {
        $this->site = new Site;
    }

/* =========================================  Unit tests =========================================*/

/* ----------------------------------------- getter and setter tests ----------------------------*/

    public function testGetSetUserName()
    {
        $username = "Cbrom";
        $this->site->setUserName($username);
        $this->assertEquals($this->site->getUsername(), $username);
    }

    public function testGetSetPassword()
    {
        $password = "thispass";
        $this->site->setPassword($password);
        $this->assertEquals($this->site->getPassword(), $password);
    }

    public function testGetSetFolderId()
    {
        $folder_id = 10;
        $this->site->setFolderId($folder_id);
        $this->assertEquals($this->site->getFolderId(), $folder_id);
    }

    public function testGetSetUrl()
    {
        $url = "https://www.google.com";
        $this->site->setUrl($url);
        $this->assertEquals($this->site->getUrl(), $url);
    }

    public function testGetSetUserId()
    {
        $user_id = 15;
        $this->site->setUserId($user_id);
        $this->assertEquals($this->site->getUserId(), $user_id);
    }

/* ---------------------------------------- Domain tests ---------------------------------*/

    /* ------------------------ notes folder_id-------------------*/

    /** @test */
    public function test_negative_folder_id_exception()
    {
        $this->expectException(NegativeUserIdException::class);
        $this->site->setFolderId(-10);
    }

    /** @test */
    public function test_empty_folder_id_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->site->setFolderId();
    }

    /** @test */
    public function test_folder_id_above_limit_exception()
    {
        $this->expectException(AboveLimitException::class);
        $this->site->setFolderId(1000000000000);
    }

    /** @test */
    public function test_string_input()
    {
        $this->site->setFolderId("2");
        $this->assertEquals($this->site->getFolderId(), 2);
    }

    /** @test */
    public function test_set_mixed_string()
    {
        $this->site->setFolderId("w2s");
        $this->assertEquals($this->site->getFolderId(), 2);
    }


    /* ------------------------ notes user_id-------------------*/

    /** @test */
    public function test_negative_user_id_exception()
    {
        $this->expectException(NegativeUserIdException::class);
        $this->site->setUserId(-10);
    }

    /** @test */
    public function test_empty_user_id_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->site->setUserId();
    }

    /** @test */
    public function test_user_id_above_limit_exception()
    {
        $this->expectException(AboveLimitException::class);
        $this->site->setUserId(1000000000000);
    }

    /** @test */
    public function test_string_user_input()
    {
        $this->site->setUserId("20");
        $this->assertEquals($this->site->getUserId(), 20);
    }

    /** @test */
    public function test_set_mixed_user_string()
    {
        $this->site->setUserId("w20s");
        $this->assertEquals($this->site->getUserId(), 20);
    }



    /* ------------------------ site username-------------------*/

    /** @test */
    public function test_empty_username_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->site->setUsername();
    }

    /** @test */
    public function test_save_uppercase_username()
    {
        $username = "cbrom";
        $expected = trim($username);
        $this->site->setUserName($username);

        $this->assertEquals($this->site->getUserName(), $expected);
    }
    /** @test */
    public function test_username_above_limit_exception()
    {
        $username = "aaaaa-bbbbb-ccccc-ddddd-eeeee-fffff-ggggg";
        $this->expectException(AboveLimitException::class);
        $this->site->setUserName($username);
    }

    /** @test */
    public function test_username_is_trimmed()
    {
        $username = " \t sldkf    ";
        $expected = trim($username);
        $this->site->setUserName($username);
        $this->assertEquals($this->site->getUserName(), $expected);
    }

    /* ------------------------ site url-------------------*/

    /** @test */
    public function test_empty_url_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->site->setUrl();
    }

    /** @test */
    public function test_invalid_url_exception()
    {
        $this->expectException(InvalidInputException::class);
        $this->site->setUrl('https:lksjdf@lksdf');
    }

    /** @test */
    public function test_url_is_trimmed()
    {
        $url = "   https://www.gmail.com";
        $expected = trim($url);
        $this->site->setUrl($url);
        $this->assertEquals($this->site->getUrl(), $expected);
    }

    /* ------------------------ site password-------------------*/

    /** @test */
    public function test_empty_password_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->site->setPassword();
    }

    /** @test */
    public function test_password_above_limit_exception()
    {
        $password = "aaaaa-bbbbb-ccccc-ddddd-eeeee-fffff-ggggg";
        $this->expectException(AboveLimitException::class);
        $this->site->setPassword($password);
    }

    /** @test */
    public function test_password_is_trimmed()
    {
        $password = " \t sldkf    ";
        $expected = trim($password);
        $this->site->setPassword($password);
        $this->assertEquals($this->site->getPassword(), $expected);
    }

    /* ======================================== Functionality tests ========================*/
}
?>