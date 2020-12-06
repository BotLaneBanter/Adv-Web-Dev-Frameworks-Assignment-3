<?php

namespace QuwisSystem\Framework;

class FrontController extends FrontController_Abstract{

    public static function run(){

        $frontController = new FrontController();
        $frontController->init();
        $frontController->handleRequest();

    }

    //Initialize helper objects as singletons(SessionManager, Validator, etc.)
    protected function init(){

        $registry = Registry::getInstance();
        $session = $registry->getSession();
        $session->create();
        $registry->getValidator();
        $header = new ResponseHeader();
        $state = new ResponseState();
        $logger = new ResponseLogger();
        $responseHandler = ResponseHandler::Instance($header, $state, $logger);

    }

    protected function handleRequest(){

        $context = new CommandContext();

        //Get the $_GET data from CommandContext
        $request = ""; 
        $get = $context->get('get');
        

        if(!empty($get)){
            $request = $get['controller'];
        }


        $handler = RequestHandlerFactory::makeRequestHandler($request);

            if($handler->execute($context) === false){
                //Do some error handling
            }
    }

}


?>