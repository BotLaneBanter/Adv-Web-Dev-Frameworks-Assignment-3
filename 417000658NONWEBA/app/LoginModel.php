<?php 

namespace app\handlers;
use QuwisSystem\Framework\Observable_Model;
use QuwisSystem\Framework\LSUMapper;
use QuwisSystem\Framework\LSUData;

class LoginModel extends Observable_Model{

    public function findAll() : array {

        //Get all contents of the users table
        $usersSQL = "SELECT * FROM users";
        $checkUsers = mysqli_query($this->db, $usersSQL);

        //Fetch records 
        $userData = [];
        while($result = $checkUsers->fetch_assoc()){
            $userData['users'][] = [ 'name' => $result['name'], 
                                     'email' => $result['email'], 
                                     'password' => $result['password'] ];
        }

        //Return an associative multidimensional array of users
        return $userData;

    }

    public function findRecord(string $id) : array {

        //Data Mapper Method
        $loginMapper = new LSUMapper();
        $loginData = $loginMapper->find($id);

        if(!is_null($loginData)){

            return ['users' => [ 'Name' => $loginData->getName(), 'Email' => $loginData->getEmail(), 'Password' => $loginData->getPassword()] ];

        }

        //If null is returned
        return ['users' => [ 'Name' => '', 'Email' => '', 'Password' => '']];

    }



}

?>