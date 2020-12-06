<?php

namespace QuwisSystem\Framework;

interface Command_Interface{

    public function execute(CommandContext $context) : bool;

}

?>