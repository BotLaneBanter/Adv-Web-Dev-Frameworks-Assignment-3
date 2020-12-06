<?php
use PHPUnit\Framework\TestCase;
use app\handlers\SignupModel;
require "config.php";
require 'autoload.php';

//WHEN RUNNING THIS TEST, ENSURE THE MOOC DATABASE WAS IMPORTERD TO PHPMYADMIN AND XAMPP SERVER IS RUNNING
//OR ELSE THE CONNECTION WILL BE REFUSED

class SignupModelTest extends TestCase{

    public function testFindAll(){

        $model = new SignupModel();
        $model->makeConnection();
        $this->assertIsArray($model->findAll());

    }

    public function testFindRecord(){

        $model = new SignupModel();
        $model->makeConnection();
        $this->assertIsArray($model->findRecord("bobross@gmail.com"));

    }

}

?>