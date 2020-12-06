<?php 

namespace QuwisSystem\Framework;

// LSU = Login and SignUp Data Object (I used one for both because it has the functionality to do so, no sense in duplicating the same class to rename it)
class LSUData extends DomainObject{

    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(string $name, string $email, string $password){

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

    }

    public function getId() : int{

        return $this->id;

    }

    public function getName() : string{

        return $this->name;

    }

    public function getEmail() : string{

        return $this->email;

    }

    public function getPassword() : string{

        return $this->password;

    }

    public function setId(int $id){

        $this->id = $id;

    }

    public function setName(string $name){

        $this->name = $name;

    }

    public function setEmail(string $email){

        $this->email = $email;

    }

    public function setPassword(string $password){

        $this->password = $password;

    }

}

?>