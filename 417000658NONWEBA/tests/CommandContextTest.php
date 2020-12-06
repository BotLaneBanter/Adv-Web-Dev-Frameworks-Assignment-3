<?php
use PHPUnit\Framework\TestCase;
use QuwisSystem\Framework\CommandContext;
require "config.php";
require 'autoload.php';


class CommandContextTest extends TestCase{

    public function testCommandContextObjectIsCreated(){

        $context = new CommandContext();
        $this->assertIsObject($context);

    }

    public function testAdd(){

        $context = new CommandContext();
        $context->add("buttered", "toast");
        $this->assertIsString($context->get("buttered"));

    }

    public function testGet(){

        $context = new CommandContext();
        $context->add("buttered", "toast");
        $val = $context->get("buttered");
        $this->assertIsString($val);

    }



}

?>