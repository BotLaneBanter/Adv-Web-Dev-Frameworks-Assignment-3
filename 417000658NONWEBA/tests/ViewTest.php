<?php
use PHPUnit\Framework\TestCase;
use QuwisSystem\Framework\View;
require "config.php";
require 'autoload.php';

class testHelper extends View{
    
    public function getTpl() : string{
        return $this->tpl;
    }

    public function getVariableData() : array{
        return $this->variable_data;
    }

}

class ViewTest extends TestCase{



public function testViewObjectIsCreated() : void
{

$this->assertIsObject(new View);

}


  
  public function testSetTemplate() {

    $view = new testHelper();
    $view->setTemplate(TPL_DIR . "/index.tpl.php");
    $this->assertIsString($view->getTpl());

    
  }

  public function testAddVar() {

    $view = new testHelper();
    $view->addVar("eggs", "benedict");
    $array = $view->getVariableData();
    $this->assertIsString($array["eggs"]);

    
  }


}

?>