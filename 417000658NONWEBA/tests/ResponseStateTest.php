<?php
use PHPUnit\Framework\TestCase;
use QuwisSystem\Framework\ResponseState;
require "config.php";
require 'autoload.php';


class ResponseStateTest extends TestCase{

    public function testStateObjectIsCreated(){

        $state = new ResponseState();
        $this->assertIsObject($state);

    }

    public function testAddShowEntries(){

        $state = new ResponseState();
        $data = [];
        $data = ['beans' => 'bacon'];
        $state->addEntries($data);
        $this->assertIsString($state->showEntry(0));

    }

    public function testShowEntries(){

        $state = new ResponseState();
        $data = ['eggs' => 'benedict'];
        $data2 = ['beans' => 'bacon'];
        $data3 = ['waffles' => 'pancakes'];
        $state->addEntries($data);
        $state->addEntries($data2);
        $state->addEntries($data3);
        $this->assertIsString($state->showEntries(0, 2));

    }



}

?>