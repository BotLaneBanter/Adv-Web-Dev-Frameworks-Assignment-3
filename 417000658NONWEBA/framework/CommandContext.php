<?php 

namespace QuwisSystem\Framework;

class CommandContext extends CommandContext_Abstract{

    public function add(string $key, $value){

        $this->data[$key] = $value;

    }

    public function get(string $key){

        if(isset($this->data[$key])){
            return $this->data[$key];
        }
        return null;

    }

    public function setError($error){

        if(empty($this->errors)){
            $this->errors[0] = $error;
            return;
        }

        $key = count($this->errors);
        $this->errors[$key] = $error;
        return;

    }

    public function getErrors() : array{

        return $this->errors;

    }
    
}

?>