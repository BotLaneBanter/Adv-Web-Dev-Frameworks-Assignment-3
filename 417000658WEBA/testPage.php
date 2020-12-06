<?php 

use QuwisSystem\Framework\FrontController;

require "C:\\xampp\\417000658NONWEBA\\config.php";
require ROOT_DIR . '/autoload.php';
use QuwisSystem\Framework\Route;

//TESTING
require FRAMEWORK_DIR .'\Route.php';
//TESTING

	
	
	//TESTING

		// Define a global basepath
define('BASEPATH', '/');

// If your script lives in a subfolder you can use the following example
// Do not forget to edit the basepath in .htaccess if you are on apache
 //define('BASEPATH','/api/v1');

function navi() {
  echo '
  Navigation:
  <ul>
      <li><a href="'.BASEPATH.'">home</a></li>
      <li><a href="'.BASEPATH.'index.php">index.php</a></li>
      <li><a href="'.BASEPATH.'user/3/edit">edit user 3</a></li>
      <li><a href="'.BASEPATH.'foo/5/bar">foo 5 bar</a></li>
      <li><a href="'.BASEPATH.'foo/bar/foo/bar">long route example</a></li>
      <li><a href="'.BASEPATH.'417000658WEBA/index.php?controller=Login">Login To Quwius</a></li>
      <li><a href="'.BASEPATH.'get-post-sample">get+post example</a></li>
      <li><a href="'.BASEPATH.'test.html">test.html</a></li>
      <li><a href="'.BASEPATH.'blog/how-to-use-include-example">How to push data to included files</a></li>
      <li><a href="'.BASEPATH.'this-route-is-not-defined">404 Test</a></li>
      <li><a href="'.BASEPATH.'this-route-is-defined">405 Test</a></li>
  </ul>
  ';
}

// Add base route (startpage)
Route::add('/', function() {
  navi();
  echo 'Welcome :-)';
});

// Another base route example
Route::add('/index.php', function() {
  navi();
  echo 'You are not really on index.php ;-)';
});

// Simple test route that simulates static html file
Route::add('/417000658WEBA/index.php?controller=Login', function() {
  navi();
  //header("Location: /417000658WEBA/Login");
  echo "BEANS";
 
});

// Add a 404 not found route
Route::pathNotFound(function($path) {
  // Do not forget to send a status header back to the client
  // The router will not send any headers by default
  // So you will have the full flexibility to handle this case
  header('HTTP/1.0 404 Not Found');
  navi();
  echo 'Error 404 :-(<br>';
  echo 'The requested path "'.$path.'" was not found!';
});

// Add a 405 method not allowed route
Route::methodNotAllowed(function($path, $method) {
  // Do not forget to send a status header back to the client
  // The router will not send any headers by default
  // So you will have the full flexibility to handle this case
  header('HTTP/1.0 405 Method Not Allowed');
  navi();
  echo 'Error 405 :-(<br>';
  echo 'The requested path "'.$path.'" exists. But the request method "'.$method.'" is not allowed on this path!';
});

// Run the Router with the given Basepath
Route::run(BASEPATH);

// Enable case sensitive mode, trailing slashes and multi match mode by setting the params to true
// Route::run(BASEPATH, true, true, true);
	
	//TESTING
	
	//FrontController::run();
	
?>