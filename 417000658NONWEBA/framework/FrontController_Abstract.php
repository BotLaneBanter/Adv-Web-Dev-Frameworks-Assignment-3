<?php 

namespace QuwisSystem\Framework;

abstract class FrontController_Abstract{

    protected $requestHandler = null;

    //Invokes controller object (regardless if an instance exists)
    abstract public static function run();

    //Initilaizes the controller with framework helper classes
    //Such as: Validator, SessionManager, ResponseHandler and any others required
    abstract protected function init();

    //Takes data passed to the frontController from GET or POST methods
    //Checks them, then passes them to the requestHandler for processing
    abstract protected function handleRequest();

}

?>