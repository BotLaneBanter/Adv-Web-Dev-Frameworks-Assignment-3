<?php
//Searches the directories specified below
//for the class/interface/abstract class passed to the autoloader
spl_autoload_register(function ($class){

    $arr = explode("\\", $class);
    $classname = $arr[count($arr)-1];

    if(file_exists(FRAMEWORK_DIR . "/" . $classname . '.php')){
        require_once FRAMEWORK_DIR . "/" . $classname . '.php';
    }
    else if(file_exists(APP_DIR . "/" . $classname . '.php')){
        require_once APP_DIR . "/" . $classname . '.php';
    }
    else if(file_exists(TPL_DIR . "/" . $classname . '.php')){
        require_once TPL_DIR . "/" . $classname . '.php';
    }
    else if(file_exists(DATA_DIR . "/" . $classname . '.php')){
        require_once DATA_DIR . "/" . $classname . '.php';
    }
    //Else throw an error that the specified file cannot be found
    /*else{ trigger_error('Cannot find class/interface/abstract definition: ' . $class, E_USER_ERROR); } */
});

?>