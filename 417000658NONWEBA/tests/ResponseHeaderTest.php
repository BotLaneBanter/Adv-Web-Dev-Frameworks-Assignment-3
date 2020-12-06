<?php
use PHPUnit\Framework\TestCase;
use QuwisSystem\Framework\ResponseHeader;
require "config.php";
require 'autoload.php';


class ResponseHeaderTest extends TestCase{

    public function testHeaderObjectIsCreated(){

        $header = new ResponseHeader();
        $this->assertIsObject($header);

    }

    public function testAddShowEntries(){

        $header = new ResponseHeader();
        $data = [];
        $data = ['beans' => 'bacon'];
        $header->addEntries($data);
        $this->assertIsString($header->showEntry(0));

    }

    public function testShowEntries(){

        $header = new ResponseHeader();
        $data = ['eggs' => 'benedict'];
        $data2 = ['beans' => 'bacon'];
        $data3 = ['waffles' => 'pancakes'];
        $header->addEntries($data);
        $header->addEntries($data2);
        $header->addEntries($data3);
        $this->assertIsString($header->showEntries(0, 2));

    }



}

?>