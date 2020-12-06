<?php
use PHPUnit\Framework\TestCase;
use QuwisSystem\Framework\ResponseHandler;
use QuwisSystem\Framework\ResponseHeader;
use QuwisSystem\Framework\ResponseState;
use QuwisSystem\Framework\ResponseLogger;
require "config.php";
require 'autoload.php';


class ResponseHandlerTest extends TestCase{

    public function testHandlerObjectIsCreated(){

        $header = new ResponseHeader();
        $state = new ResponseState();
        $logger = new ResponseLogger();
        ResponseHandler::Instance($header, $state, $logger);
        $responseHandler = ResponseHandler::getInstance();
        $this->assertIsObject($responseHandler);

    }

    public function testGetState(){

        $header = new ResponseHeader();
        $state = new ResponseState();
        $logger = new ResponseLogger();
        ResponseHandler::Instance($header, $state, $logger);
        $responseHandler = ResponseHandler::getInstance();
        $getState = $responseHandler->giveState();
        $this->assertIsObject($getState);

    }

    public function testGetLogger(){

        $header = new ResponseHeader();
        $state = new ResponseState();
        $logger = new ResponseLogger();
        ResponseHandler::Instance($header, $state, $logger);
        $responseHandler = ResponseHandler::getInstance();
        $getLogger = $responseHandler->giveLogger();
        $this->assertIsObject($getLogger);

    }

    public function testGetHeader(){

        $header = new ResponseHeader();
        $state = new ResponseState();
        $logger = new ResponseLogger();
        ResponseHandler::Instance($header, $state, $logger);
        $responseHandler = ResponseHandler::getInstance();
        $getHeader = $responseHandler->giveHeader();
        $this->assertIsObject($getHeader);

    }


}

?>