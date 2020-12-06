<?php 

namespace QuwisSystem\Framework;

class UsersCollection extends genCollection{

//Ensures only UserData objects are added to the collection
public function targetClass() : string{

    return UserData::class;

}

}

?>