<?php 

namespace QuwisSystem\Framework;

abstract class Model {

//Stores cached json files so they only need to be loaded once
protected $cached_json = [];

abstract public function findAll() : array;
abstract public function findRecord(string $id) : array;

public function loadData(string $fromFile) : array{

    //Create filename without (essentially stripping) .json extension
    $filename = basename($fromFile, '.json');

    //Check if the file has already been cached (saves time and resources) before
    //fetching file contents by checking if the associaion exists in the array or if
    //he array has been set
    if(!isset($this->cached_json[$filename]) || empty($this->cached_json[$filename])){

        //Get the json file contents
        $jsonFileContents = file_get_contents($fromFile);
        //Decode the json file into a multidimensional associate array
        $this->cached_json[$filename] = json_decode($jsonFileContents, true);
        
    }

    //Check the array isn't null and the association exists
    if(isset($this->cached_json[$filename])){

        //Return the stored associative muli-dimensional array
        return $this->cached_json[$filename];

    }

    //Else jus return the empty array
    return $this->cached_json;

}

//Establish a connection with the database server
abstract public function makeConnection();

}

?>