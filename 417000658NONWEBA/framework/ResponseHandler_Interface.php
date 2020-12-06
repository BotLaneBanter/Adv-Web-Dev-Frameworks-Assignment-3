<?php

namespace QuwisSystem\Framework;

interface ResponseHandler_Interface{

    //Returns the respective ResponseHeader, ResponseState and ResponseLogger objects

    public function giveHeader() : ResponseHeader;

    public function giveState() : ResponseState;

    public function giveLogger() : ResponseLogger;

}

?>