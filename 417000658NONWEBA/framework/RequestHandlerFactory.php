<?php

namespace QuwisSystem\Framework;

class RequestHandlerFactory implements RequestHandlerFactory_Interface{

    //CHANGE INDEX BACK TO DEFAULT LATER (ONLY CHANGED TO TEST IF IT WORKS)
    public static function makeRequestHandler(string $request = 'Index'): PageController_Command_Abstract
    {
        if (preg_match('/\W/', $request)) {

        throw new Exception("Illegal Characters In Action");

        }

        if(empty($request)){
            $request = "Index";
        }
       
        $class = "app\\handlers\\" . UCFirst(strtolower($request)) . "Controller";
        
        if (! class_exists($class)) {
       
            throw new CommandNotFoundException("No Request Handler Class: '$class' Located");
      
        }
       
        $cmd = new $class(); // the receiver can go here
        return $cmd;
    
    }

}

?>