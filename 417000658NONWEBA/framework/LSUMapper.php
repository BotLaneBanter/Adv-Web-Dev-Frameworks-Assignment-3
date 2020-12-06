<?php 

namespace QuwisSystem\Framework;

// LSU = Login and SignUp Data Mapper (I used one for both because it has the functionality to do so, no sense in duplicating the same class to rename it)
class LSUMapper extends Mapper{

    private $selectStmt;
    private $updateStmt;
    private $insertStmt;

    public function __construct(){

        parent::__construct();
        $this->selectStmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $this->updateStmt = $this->pdo->prepare("UPDATE users SET name = ? WHERE email = ?");
        $this->insertStmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

    }

    protected function targetClass() : string{

        return LSUData::class;

    }

    protected function doCreateObject(array $rawData) : DomainObject{

        $obj = new LSUData($rawData["name"], $rawData["email"], $rawData["password"]);
        return $obj;

    }

    protected function doInsert(DomainObject $object){

        $values = [$object->getName(), $object->getEmail(), $object->getPassword()];
        $this->insertStmt->execute($values);
        $id = $this->pdo->lastInsertId();
        $object->setId((int)$id);

    }

    //UNUSED
    public function update(DomainObject $object){

        $values = [$object->getName(), $object->getEmail(), $object->getPassword()];
        $this->updateStmt->execute($values);

    }

    public function selectStmt() : \PDOStatement{

        return $this->selectStmt;

    }

}

?>