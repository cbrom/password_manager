<?php
use PHPUnit\Framework\TestCase;
require_once 'app/models/User.php';
require_once 'app/Exceptions/Exceptions.php';
require_once 'app/core/Validate.php';

class UsersTest extends TestCase
{
    protected $user = NULL;

    public function setUp()
    {
        $this->user = new User;
    }

/* =========================================  Unit tests =========================================*/

/* ----------------------------------------- getter and setter tests ----------------------------*/

    public function testGetSetUserName()
    {
        $username = "Cbrom";
        $this->user->setUserName($username);
        $this->assertEquals($this->user->getUsername(), $username);
    }

    public function testGetSetEmail()
    {
        $email = "kk@gmail.com";
        $this->user->setEmail($email);
        $this->assertEquals($this->user->getEmail(), $email);
    }

/* ---------------------------------------- Domain tests ---------------------------------*/

    /* ------------------------ user username-------------------*/

    /** @test */
    public function test_empty_username_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->user->setUsername();
    }

    /** @test */
    public function test_save_uppercase_username()
    {
        $username = "cbrom";
        $expected = ucfirst($username);
        $this->user->setUserName($username);

        $this->assertEquals($this->user->getUserName(), $expected);
    }
    /** @test */
    public function test_username_above_limit_exception()
    {
        $username = "aaaaa-bbbbb-ccccc-ddddd-eeeee-fffff-ggggg";
        $this->expectException(AboveLimitException::class);
        $this->user->setUserName($username);
    }

    /** @test */
    public function test_username_is_trimmed()
    {
        $username = " \t sldkf    ";
        $expected = ucfirst(trim($username));
        $this->user->setUserName($username);
        $this->assertEquals($this->user->getUserName(), $expected);
    }

    /* ------------------------ user email-------------------*/

    /** @test */
    public function test_empty_email_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->user->setEmail();
    }

    /** @test */
    public function test_invalid_email_exception()
    {
        $this->expectException(InvalidInputException::class);
        $this->user->setEmail('klsdkj.com');
    }

    /** @test */
    public function test_email_is_trimmed()
    {
        $email = "   cs@gmail.com ";
        $expected = trim($email);
        $this->user->setEmail($email);
        $this->assertEquals($this->user->getEmail(), $expected);
    }

    /* ======================================== Functionality tests ========================*/
}
?>