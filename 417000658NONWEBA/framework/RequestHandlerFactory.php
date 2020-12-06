<?php

namespace QuwisSystem\Framework;

class RequestHandlerFactory implements RequestHandlerFactory_Interface{

    //CHANGE INDEX BACK TO DEFAULT LATER (ONLY CHANGED TO TEST IF IT WORKS)
    public static function makeRequestHandler(): PageController_Command_Abstract
    {

        //Parse the url, breaking it down into two parts
        $parsedURL = parse_url($_SERVER['REQUEST_URI']);

        //Check if the query is valid
        //If not, give it a default value of index
        if(!isset($parsedURL['query'])){

            $parsedURL['query'] = "Index";

        }


        if (preg_match('/\W/', $parsedURL['query'])) {

        throw new Exception("Illegal Characters In Action");

        }
       
        $class = "app\\handlers\\" . UCFirst(strtolower($parsedURL['query'])) . "Controller";
        
        if (! class_exists($class)) {
       
            throw new CommandNotFoundException("No Request Handler Class: '$class' Located");
      
        }
       
        $cmd = new $class(); // the receiver can go here
        return $cmd;
    
    }

}

?>