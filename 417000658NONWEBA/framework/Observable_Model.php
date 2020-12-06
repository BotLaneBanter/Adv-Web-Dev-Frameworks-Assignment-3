<?php 

namespace QuwisSystem\Framework;

abstract class Observable_Model extends Model implements Observable {

protected $observersArray = [];
protected $updateData = [];
protected $db;

//Attach an observer to the array
public function attach(Observer $observer){

	$this->observersArray[] = $observer;

}

//Remove an observer from the array
public function detach(Observer $observer){

	$this->observersArray = array_filter($this->observersArray, function ($a) use ($observerableObj) { 
														return ( !( $a == $observerableObj) ); 
														});

}

//Notify all of the observers of changes
public function notify(){

	foreach($this->observersArray as $obs){
		$obs->update($this);	
	}

}

//Return updateData array
public function giveUpdateData(){

return $this->updateData;

}

//Update changed data (CHECK THIS IN CASE STUFF GOES WRONG, COULD MEAN THE VARIABLE IS THE WRONG ONE)
public function updateChangedData($data){

	$this->updateData = $data;

}

//Establish a connection with the mooc database
public function makeConnection(){

	 //Variables
	 $servername = "localhost";
	 $username = "root";
	 $password = "";
	 $database = "mooc";
	 
	 // Create connection
	 $conn = new \mysqli($servername, $username, $password, $database);
	 
	 // Check connection
	 if ($conn->connect_error) {
		 die("Connection failed: " . $conn->connect_error);
	 } 
	 
	 $this->db = $conn;
	 
}

//Get all records from the JSON file and returns them in a multi-dimensional associative array
abstract public function findAll() : array;
abstract public function findRecord(string $id) : array;

}
?>