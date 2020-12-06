<?php
use PHPUnit\Framework\TestCase;
use app\handlers\IndexController;
require "config.php";
require 'autoload.php';


class PageControllerTest extends TestCase{

    public function testControllerObjectIsCreated(){

        $controller = new IndexController();
        $this->assertIsObject($controller);

    }

    public function testMakeModel(){

        $controller = new IndexController();
        $model = $controller->makeModel("index");
        $this->assertIsObject($model);

    }

    public function testMakeView(){

        $controller = new IndexController();
        $view = $controller->makeView("index");
        $this->assertIsObject($view);

    }


}

?>