<?php 

namespace QuwisSystem\Framework;

interface RequestHandlerFactory_Interface{

    public static function makeRequestHandler(string $request='Index') : PageController_Command_Abstract;

}

?>