<?php

namespace QuwisSystem\Framework;

class SessionManager{
	

	//Hard coded for now to just manage the session and the respective users
	//protected $access = ['profile'=>['tester@comp3170.com','bobross@gmail.com', 'joseph.hewitt@mycavehill.uwi.edu', 'test.user@mycavehill.uwi.edu', 'eggs.benedict@outlook.com'], 'courses' => ['tester@comp3170.com','bobross@gmail.com', 'joseph.hewitt@mycavehill.uwi.edu', 'test.user@mycavehill.uwi.edu', 'eggs.benedict@outlook.com']];
	protected $access;

public function __construct(){

	//Use the generator collection to populate the access array of user emails
	$userDataMapper = new UDMapper();
	$userDataCollection = $userDataMapper->findAllEmails();
	$userData = $userDataCollection->getGenerator();

	//Set up associative arrays
	$this->access = [];

	$this->access['profile'] = [];
	$this->access['courses'] = [];

	foreach($userData as $object){

		$this->access['profile'][] = $object->getEmail();
		$this->access['courses'][] = $object->getEmail();

	}


}

public function create() : void
{
	session_start();
}

public function destroy() : void 
{
	setcookie('key', time() - 3600);
	session_unset();
	session_destroy();

}

public function add($name, $value)
{
	if(isset($_SESSION)){
		$_SESSION[$name] = $value;
	}

}

public function receive($name){

	if(isset($_SESSION[$name])){
		return $_SESSION[$name];
	}
	return null;

}

public function remove($name){

	if(isset($_SESSION[$name])){
		unset($_SESSION[$name]);
	}
}

public function accessible($user, $page) : bool {

	if(isset($_SESSION)){
		if(in_array($user, $this->access[$page])){
			return true;
		}
	}
	return false;

}
	
}