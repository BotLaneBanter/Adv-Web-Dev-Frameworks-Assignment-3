<?php 

namespace QuwisSystem\Framework;

//Class to hold user emails for access array in SessionManager
class UserData extends DomainObject{

    private $id;
    private $email;

    public function __construct(string $email){

        $this->email = $email;

    }

    public function getId() : int{

        return $this->id;

    }

    public function getEmail() : string{

        return $this->email;

    }

    public function setId(int $id){

        $this->id = $id;

    }

    public function setEmail(string $name){

        $this->email = $email;

    }



}

?>