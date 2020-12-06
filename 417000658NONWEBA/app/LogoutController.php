<?php

namespace app\handlers;
use QuwisSystem\Framework\CommandContext;
use QuwisSystem\Framework\PageController_Command_Abstract;
use QuwisSystem\Framework\SessionManager;
use QuwisSystem\Framework\Logout;

class LogoutController extends PageController_Command_Abstract{

    private $objectData = null;

public function run(){

    $logout = new Logout();
    $logout->logOutUser();

}

public function execute(CommandContext $context) : bool{

    $this->objectData = $context;
    $this->run();
    return true;

}


}

?>