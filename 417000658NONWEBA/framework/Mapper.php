<?php

namespace QuwisSystem\Framework; 

abstract class Mapper{

    protected $pdo;

    public function __construct(){

        $registry = Registry::getInstance();
        $this->pdo = $registry->getPDO();

    }

    public function find(string $email){

        $this->selectstmt()->execute([$email]);
        $row = $this->selectstmt()->fetch();
        $this->selectstmt()->closeCursor();

        if(!is_array($row)){
            return null;
        }
        if(!isset($row['email'])){
            return null;
        }
        $object = $this->createObject($row);
        return $object;

    }


    public function createObject(array $rawData) : DomainObject{

        $obj = $this->doCreateObject($rawData);
        return $obj;

    }

    public function insert(DomainObject $obj){

        $this->doInsert($obj);

    }

    //Abstract functions
    abstract public function update(DomainObject $object);
    abstract protected function doCreateObject(array $rawData) : DomainObject;
    abstract protected function doInsert(DomainObject $object);
    abstract protected function selectStmt() : \PDOStatement;
    abstract protected function targetClass() : string;

}

?>