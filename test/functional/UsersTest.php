<?php
use PHPUnit\Framework\TestCase;
require_once 'app/models/User.php';
require_once 'app/Exceptions/Exceptions.php';
require_once 'app/core/Validate.php';

class UsersFunctionalTest extends TestCase
{
    protected $user = NULL;

    public function setUp()
    {
        $this->user = new User;
    }

/* =========================================  Unit tests =========================================*/

/* ======================================== Functionality tests ========================*/
     /*----------------------------add note -----------------------*/
        /** @test */
        public function test_a_new_user_is_add()
        {
            $this->user->setUserName("lL");
            $this->assertEquals($this->user->getUserName(), "LL");
        }
}
?>