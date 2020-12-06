<?php 

namespace QuwisSystem\Framework;

class Registry{

    private static $uniqueInstance = null;
    private $session = null;
    private $validator = null;
    private $pdo = null;

    public static function getInstance() : self{

        if(is_null(self::$uniqueInstance)){
            self::$uniqueInstance = new Registry();
        }
        return self::$uniqueInstance;

    }

    public function getSession() : SessionManager{

        if(is_null($this->session)){
            $this->session = new SessionManager();
        }
        return $this->session;

    }

    public function getValidator() : Validator{

        if(is_null($this->validator)){
            $this->validator = new Validator();
        }
        return $this->validator;

    }

    public function getPDO() : \PDO{

        $user = "root";
        $pass = "";

        if(is_null($this->pdo)){
            $this->pdo = new \PDO('mysql:host=localhost;dbname=mooc', $user, $pass);
        }
        return $this->pdo;

    }

}

?>