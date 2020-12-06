<?php
use PHPUnit\Framework\TestCase;
use QuwisSystem\Framework\Validator;
require "config.php";
require 'autoload.php';


class ValidatorTest extends TestCase{

    public function testValidatorObjectIsCreated(){

        $validator = Validator::getInstance();
        $this->assertIsObject($validator);

    }

    public function testValidEmail(){

        $validator = Validator::getInstance();
        $this->assertTrue($validator->isEmailValid("bobross@gmail.com"));

    }

    public function testInvalidEmail(){

        $validator = Validator::getInstance();
        $this->assertFalse($validator->isEmailValid("bobross@gmail"));

    }

    public function testValidPassword(){

        $validator = Validator::getInstance();
        $this->assertTrue($validator->isPasswordValid("Testpassw0rd"));

    }

    public function testInvalidPassword(){

        $validator = Validator::getInstance();
        $this->assertFalse($validator->isPasswordValid("testpassword"));

    }



}

?>