<?php
use PHPUnit\Framework\TestCase;
use QuwisSystem\Framework\ResponseLogger;
require "config.php";
require 'autoload.php';


class ResponseLoggerTest extends TestCase{

    public function testLoggerObjectIsCreated(){

        $logger = new ResponseLogger();
        $this->assertIsObject($logger);

    }

    public function testAddShowEntries(){

        $logger = new ResponseLogger();
        $data = [];
        $data = ['beans' => 'bacon'];
        $logger->addEntries($data);
        $this->assertIsString($logger->showEntry(0));

    }

    public function testShowEntries(){

        $logger = new ResponseLogger();
        $data = ['eggs' => 'benedict'];
        $data2 = ['beans' => 'bacon'];
        $data3 = ['waffles' => 'pancakes'];
        $logger->addEntries($data);
        $logger->addEntries($data2);
        $logger->addEntries($data3);
        $this->assertIsString($logger->showEntries(0, 2));

    }



}

?>