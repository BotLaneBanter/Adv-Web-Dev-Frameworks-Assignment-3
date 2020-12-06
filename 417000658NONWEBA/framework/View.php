<?php

namespace QuwisSystem\Framework;

class View implements Observer{

//Stores all of the variables which will be displayed in the php Template
//protected $data;

//Template to be displayed with any error information
protected $tpl = '';
protected $variable_data = [];

//update variable_data with changes from Observable_Model
public function update(Observable_Model $observableObject){

	$vars = $observableObject->giveUpdateData();
	
	foreach($vars as $name => $value){
		$this->addVar($name, $value);
	}
	$this->display();

}

//Sets the $tpl variable to the provided filename
public function setTemplate(string $filename) : void 
{
	//Check if the filename was specified
	if(empty($filename)){
		trigger_error("File not specified", E_USER_ERROR);
	}
	//Check if the file exists
	else if(!file_exists($filename)){
		trigger_error("File does not exist", E_USER_ERROR);
	}
	//Assign the filename to $tpl
	else{
	$this->tpl = $filename;
	}
	
}

//Add a named value to the $variables array
public function addVar(string $name, $value) : void
{
	//Check to see if a valid variable name was provided, if i was no, throw an error
	if(preg_match('/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$/', $name) == 0){
		trigger_error('Invalid Variable Name Used', E_USER_ERROR);
	}
	//Assign the name and value to the array
	$this->variable_data[$name] = $value;
}

public function display() : void 
{
	//Loads the specified file
	extract($this->variable_data); 
	require $this->tpl;
}

}

?>