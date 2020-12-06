<?php 

namespace QuwisSystem\Framework;

abstract class CommandContext_Abstract{

    //Data storage for context
    protected $data = [];

    //Stores error messages
    protected $errors = [];

    //Initializes the command data property with the data stored within POST and GET
    //Has a parameter sub-array for user defined variables
    public function __construct(){

        $this->data['post'] = $_POST;
        $this->data['get'] = $_GET;
        $this->data['params'] = [];

    }

    //Adds a new variable to the context in the parameter sub-array
    abstract public function add(string $key, $value);

    //Retrieves stored variables using provided key
    abstract public function get(string $key);

    //Set errors
    abstract protected function setError($error);

    //Retrieves all errors from the $errors array within the context
    abstract public function getErrors() : array;

}

?>