<?php 

namespace QuwisSystem\Framework;

class ResponseHandler implements ResponseHandler_Interface{

    private static $uniqueInstance = null;
    protected $Header = null;
    protected $State = null;
    protected $Logger = null;

    private function __construct(ResponseHeader $header, ResponseState $state, ResponseLogger $logger){

        $this->Header = $header;
        $this->State = $state;
        $this->Logger = $logger;

    }

    public static function Instance(ResponseHeader $header, ResponseState $state, ResponseLogger $logger){

        if(empty(self::$uniqueInstance)){
            self::$uniqueInstance = new ResponseHandler($header, $state, $logger);
        }

    }

    public static function getInstance(){

        if(!empty(self::$uniqueInstance)){
            return self::$uniqueInstance;
        }

    }

    public function giveHeader() : ResponseHeader{

        return clone $this->Header;

    }

    public function giveState() : ResponseState{

        return clone $this->State;

    }

    public function giveLogger() : ResponseLogger{

        return clone $this->Logger;

    }

    //Error Logging
    public function storeErrorLogs(){

        if(isset($php_errormsg)){
            $this->Logger->addEntries(['phperror' => ['Log' => $php_errormsg, 'Time' => time()]]);
        }

    }

    public function storeHeaders(){

        $this->Header->addEntries([$_SERVER['SERVER_NAME']]);
        $this->Header->addEntries([$_SERVER['SERVER_SOFTWARE']]);
        $this->Header->addEntries([$_SERVER['SCRIPT_FILENAME']]);

    }

}

?>