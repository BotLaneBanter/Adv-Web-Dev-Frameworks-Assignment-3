<?php 

namespace QuwisSystem\Framework;

// UD = User Data Mapper 
class UDMapper extends Mapper{

    private $selectStmt;
    private $selectAllEmailStmt;
    private $updateStmt;
    private $insertStmt;

    public function __construct(){

        parent::__construct();
        $this->selectStmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $this->selectAllEmailStmt = $this->pdo->prepare("SELECT email FROM users");
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

    //Personal select statement to get all emails from user table
    public function selectAllEmailStmt() : \PDOStatement{

        return $this->selectAllEmailStmt;

    }

    //Grab all user emails from the db
    public function findAllEmails(){

        //Instantiate a collection
        $userCollection = new UsersCollection();

        $this->selectAllEmailStmt()->execute();
        

        while($row = $this->selectAllEmailStmt()->fetch()){

            $userCollection->add(new UserData($row['email']));

        }

        $this->selectAllEmailStmt()->closeCursor();
        return $userCollection;

    }

    

}

?>