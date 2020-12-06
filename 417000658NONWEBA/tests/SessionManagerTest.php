<?php
use PHPUnit\Framework\TestCase;
use QuwisSystem\Framework\SessionManager;
require "config.php";
require 'autoload.php';

class SessionManagerTest extends TestCase{

//Is the SessionManager object created
public function testSessionObjectIsCreated() : void
{

$this->assertIsObject(new SessionManager);	

$session = SessionManager::getInstance();
$this->assertIsObject($session);

}

//Check a session object is created

/*public function testSessionClassSessionIsCreated() : void
{
	$session = SessionManager::getInstance();
	$session->create();
	$this->assertIsArray($_SESSION);
	
}*/

	
}
?>