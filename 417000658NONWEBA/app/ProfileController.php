<?php

namespace app\handlers;
use QuwisSystem\Framework\PageController_Command_Abstract;
use QuwisSystem\Framework\SessionManager;
use QuwisSystem\Framework\View;
use QuwisSystem\Framework\CommandContext;
use QuwisSystem\Framework\Logout;
use QuwisSystem\Framework\Registry;
use ProfileModel;

class ProfileController extends PageController_Command_Abstract{

    private $objectData = null;

public function run(){
    
    //Start a new session and check if the user can be on this page
    $registry = Registry::getInstance();
    $session = $registry->getSession();

    //Creates and sets the respective view and model objects
    $view = $this->makeView('Profile');
    $model = $this->makeModel('Profile');
    $this->setView($view);
    $this->setModel($model);

    //Attach the view to the observable_model so the view can recieve updates from it
    $this->observableModel->attach($this->view);
    //If data is needed from the model, get the array of data
    //(In this case it returns the sorted multi-dimensional array of popular/recommended courses)
    $data = $this->observableModel->findAll();
    
    if(!$session->accessible($session->receive("Email"), "profile")){
       
        $session->remove("Email");
        header('Location: index.php');

    }
    //Load the page normally
    else
    {
        //Tell the model to update the data which changed
        $this->observableModel->updateChangedData($data);  

        //Tell the model to notify it's attached observers, pushing the updated data to them
        $this->observableModel->notify();
    }

}

public function execute(CommandContext $context) : bool{

    $this->objectData = $context;
    $this->run();
    return true;

}


}

?>