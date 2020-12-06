<?php 

namespace QuwisSystem\Framework;

interface RequestHandlerFactory_Interface{

    public static function makeRequestHandler() : PageController_Command_Abstract;

}

?>