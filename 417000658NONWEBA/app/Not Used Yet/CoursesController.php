<?php

class CoursesController extends Controller{

public function run(){

    //Set the webpage template to be displayed
    $view = new View();
    $view->setTemplate(TPL_DIR . '/courses.tpl.php');

    //Start a new session and check if the user can be on this page
    $session = new SessionManager();
    $session->create();

    //Set the model to a new Observable_Model object
    $this->setModel(new CoursesModel);
    //Set the view to the previously created view object
    $this->setView($view);

    //Attach the view to the observable_model so the view can recieve updates from it
    $this->observableModel->attach($this->view);
    //If data is needed from the model, get the array of data
    //(In this case it returns the sorted multi-dimensional array of popular/recommended courses)
    $data = $this->observableModel->getAll();
    
    if(!$session->accessible($session->receive("Email"), "profile")){
        $session->destroy();
        header('Location: index.php');
    }
    else if((isset($_GET['controller'])) && ($_GET['controller'] == 'Profile')){
        header('Location: profile.php');
    }
    //If logout was clicked create a logout object and call the logout
    //Function to logout the user
    else if((isset($_GET['controller'])) && ($_GET['controller'] == 'Logout')){
        $logout = new Logout();
        $logout->logOutUser();
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


}