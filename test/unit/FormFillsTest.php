<?php
use PHPUnit\Framework\TestCase;
require_once 'app/models/FormFill.php';
require_once 'app/Exceptions/Exceptions.php';
require_once 'app/core/Validate.php';

class FormFillsTest extends TestCase
{
    protected $formfill = NULL;

    public function setUp()
    {
        $this->formfill = new FormFill;
    }

/* =========================================  Unit tests =========================================*/

/* ----------------------------------------- getter and setter tests ----------------------------*/


    public function testGetSetUserId()
    {
        $user_id = 15;
        $this->formfill->setUserId($user_id);
        $this->assertEquals($this->formfill->getUserId(), $user_id);
    }

    public function testGetSetFormType()
    {
        $formtype = "Educational";
        $this->formfill->setFormType($formtype);
        $this->assertEquals($this->formfill->getFormType(), $formtype);
    }

    public function testGetSetFirstName()
    {
        $firstname = "Cbrom";
        $this->formfill->setFirstName($firstname);
        $this->assertEquals($this->formfill->getFirstName(), $firstname);
    }


    public function testGetSetLastName()
    {
        $lastname = "Cbrom";
        $this->formfill->setLastName($lastname);
        $this->assertEquals($this->formfill->getLastName(), $lastname);
    }

    public function testGetSetUserName()
    {
        $username = "Cbrom";
        $this->formfill->setUserName($username);
        $this->assertEquals($this->formfill->getUsername(), $username);
    }

    public function testGetSetEmail()
    {
        $email = "kk@gmail.com";
        $this->formfill->setEmail($email);
        $this->assertEquals($this->formfill->getEmail(), $email);
    }

    public function testGetSetAddress()
    {
        $address = "Address";
        $this->formfill->setAddress($address);
        $this->assertEquals($this->formfill->getAddress(), $address);
    }

    public function testGetSetGender()
    {
        $gender = 1;
        $this->formfill->setGender($gender);
        $this->assertEquals($this->formfill->getGender(), $gender);
    }

    

/* ---------------------------------------- Domain tests ---------------------------------*/


    /* ------------------------ notes user_id-------------------*/

    /** @test */
    public function test_negative_user_id_exception()
    {
        $this->expectException(NegativeUserIdException::class);
        $this->formfill->setUserId(-10);
    }

    /** @test */
    public function test_empty_user_id_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->formfill->setUserId();
    }

    /** @test */
    public function test_user_id_above_limit_exception()
    {
        $this->expectException(AboveLimitException::class);
        $this->formfill->setUserId(1000000000000);
    }

    /** @test */
    public function test_string_user_input()
    {
        $this->formfill->setUserId("20");
        $this->assertEquals($this->formfill->getUserId(), 20);
    }

    /** @test */
    public function test_set_mixed_user_string()
    {
        $this->formfill->setUserId("w20s");
        $this->assertEquals($this->formfill->getUserId(), 20);
    }


    /* ------------------------ formfill firstname-------------------*/

    /** @test */
    public function test_empty_firstname_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->formfill->setFirstName();
    }

    /** @test */
    public function test_save_uppercase_firstname()
    {
        $firstname = "cbrom";
        $expected = ucfirst($firstname);
        $this->formfill->setFirstName($firstname);

        $this->assertEquals($this->formfill->getFirstName(), $expected);
    }
    /** @test */
    public function test_firstname_above_limit_exception()
    {
        $firstname = "aaaaa-bbbbb-ccccc-ddddd-eeeee-fffff-ggggg";
        $this->expectException(AboveLimitException::class);
        $this->formfill->setFirstName($firstname);
    }

    /** @test */
    public function test_firstname_is_trimmed()
    {
        $firstname = " \t sldkf    ";
        $expected = ucfirst(trim($firstname));
        $this->formfill->setFirstName($firstname);
        $this->assertEquals($this->formfill->getFirstName(), $expected);
    }


    /* ------------------------ formfill lastname-------------------*/

    /** @test */
    public function test_empty_lastname_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->formfill->setLastName();
    }

    /** @test */
    public function test_save_uppercase_lastname()
    {
        $lastname = "cbrom";
        $expected = ucfirst($lastname);
        $this->formfill->setLastName($lastname);

        $this->assertEquals($this->formfill->getLastName(), $expected);
    }
    /** @test */
    public function test_lastname_above_limit_exception()
    {
        $lastname = "aaaaa-bbbbb-ccccc-ddddd-eeeee-fffff-ggggg";
        $this->expectException(AboveLimitException::class);
        $this->formfill->setLastName($lastname);
    }

    /** @test */
    public function test_lastname_is_trimmed()
    {
        $lastname = " \t sldkf    ";
        $expected = ucfirst(trim($lastname));
        $this->formfill->setLastName($lastname);
        $this->assertEquals($this->formfill->getLastName(), $expected);
    }



    /* ------------------------ formfill username-------------------*/

    /** @test */
    public function test_empty_username_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->formfill->setUsername();
    }

    /** @test */
    public function test_save_uppercase_username()
    {
        $username = "cbrom";
        $expected = ucfirst($username);
        $this->formfill->setUserName($username);

        $this->assertEquals($this->formfill->getUserName(), $expected);
    }
    /** @test */
    public function test_username_above_limit_exception()
    {
        $username = "aaaaa-bbbbb-ccccc-ddddd-eeeee-fffff-ggggg";
        $this->expectException(AboveLimitException::class);
        $this->formfill->setUserName($username);
    }

    /** @test */
    public function test_username_is_trimmed()
    {
        $username = " \t sldkf    ";
        $expected = ucfirst(trim($username));
        $this->formfill->setUserName($username);
        $this->assertEquals($this->formfill->getUserName(), $expected);
    }

    /* ------------------------ form fill formtype-------------------*/

    /** @test */
    public function test_empty_formtype_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->formfill->setFormType();
    }

    /** @test */
    public function test_formtype_above_limit_exception()
    {
        $formtype = "aaaaa-bbbbb-ccccc-ddddd-eeeee-fffff-ggggg";
        $this->expectException(AboveLimitException::class);
        $this->formfill->setFormType($formtype);
    }

    /** @test */
    public function test_formtype_is_trimmed()
    {
        $formtype = " \t sldkf    ";
        $expected = ucfirst(trim($formtype));
        $this->formfill->setFormType($formtype);
        $this->assertEquals($this->formfill->getFormType(), $expected);
    }

    /* ------------------------ formfill email-------------------*/

    /** @test */
    public function test_empty_email_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->formfill->setEmail();
    }

    /** @test */
    public function test_invalid_email_exception()
    {
        $this->expectException(InvalidInputException::class);
        $this->formfill->setEmail('klsdkj.com');
    }

    /** @test */
    public function test_email_is_trimmed()
    {
        $email = "   cs@gmail.com ";
        $expected = trim($email);
        $this->formfill->setEmail($email);
        $this->assertEquals($this->formfill->getEmail(), $expected);
    }

    /* ------------------------ formfill address-------------------*/

    /** @test */
    public function test_empty_address_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->formfill->setAddress();
    }

    /** @test */
    public function test_address_above_limit_exception()
    {
        $address = "aaaaa-bbbbb-ccccc-ddddd-eeeee-fffff-ggggg";
        $this->expectException(AboveLimitException::class);
        $this->formfill->setAddress($address);
    }

    /** @test */
    public function test_address_is_trimmed()
    {
        $address = " \t 1    ";
        $expected = trim($address);
        $this->formfill->setAddress($address);
        $this->assertEquals($this->formfill->getAddress(), $expected);
    }

    /* ------------------------ formfill gender-------------------*/

    /** @test */
    public function test_invalid_gender_exception()
    {
        $this->expectException(InvalidInputException::class);
        $this->formfill->setGender("lksjd");
    }

    /** @test */
    public function test_negative_gender_exception()
    {
        $this->expectException(NegativeUserIdException::class);
        $this->formfill->setGender(-10);
    }

    /** @test */
    public function test_gender_above_limit_exception()
    {
        $this->expectException(AboveLimitException::class);
        $this->formfill->setGender(2);
    }

    /** @test */
    public function test_string_gender_input()
    {
        $this->formfill->setGender("1");
        $this->assertEquals($this->formfill->getGender(), 1);
    }

    /** @test */
    public function test_set_mixed_gender_string()
    {
        $this->formfill->setGender("w1s");
        $this->assertEquals($this->formfill->getGender(), 1);
    }

    /** @test */
    public function test_empty_gender_exception()
    {
        $this->expectException(InputEmptyException::class);
        $this->formfill->setGender();
    }


    /* ======================================== Functionality tests ========================*/
}
?>