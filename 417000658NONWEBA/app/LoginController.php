<?php 

namespace app\handlers;
use QuwisSystem\Framework\PageController_Command_Abstract;
use QuwisSystem\Framework\Validator;
use QuwisSystem\Framework\SessionManager;
use QuwisSystem\Framework\View;
use QuwisSystem\Framework\CommandContext;
use QuwisSystem\Framework\ResponseHandler;
use QuwisSystem\Framework\ResponseHeader;
use QuwisSystem\Framework\ResponseState;
use QuwisSystem\Framework\ResponseLogger;
use QuwisSystem\Framework\Registry;
use QuwisSystem\Framework\LSUMapper;
use QuwisSystem\Framework\LSUData;

use LoginModel;

class LoginController extends PageController_Command_Abstract{

    private $objectData = null;

    public function run(){

        //Get instance of registry then get validator and session
        $registry = Registry::getInstance();
        $validate = $registry->getValidator();
        $session = $registry->getSession();

        //Creates and sets the respective view and model objects
        $view = $this->makeView('Login');
        $model = $this->makeModel('Login');
        $this->setView($view);
        $this->setModel($model);

        //Establish a connection with the database
        $this->observableModel->makeConnection();

        //Attach the view to the observable_model so the view can recieve updates from it
        $this->observableModel->attach($this->view);
        //If data is needed from the model, get the array of data
        //(In this case it returns the multi-dimensional array of users)
        $data = $this->observableModel->findAll();


        if(isset($_POST['login'])){

            //POSTED user array from CommandContext
            $userPOSTData = $this->objectData->get('post');

            $userRecord = $this->observableModel->findRecord($userPOSTData['email']);
            $hashedPassword = "";
            $hashedPassword = $userRecord['users']['Password'];

            $validate->isEmailValid($userPOSTData['email']);
            $validate->isPasswordValid($userPOSTData['password']);
            $validate->passwordHashMatch($userPOSTData['password'], $hashedPassword);

                if(!$validate->getErrorThrown()){

                     //Get ResponseHandler
                     $responseHandler = ResponseHandler::getInstance();
                     
                     //Get clone of State
                     $state = $responseHandler->giveState();

                     //Make array with Profile in it
                     $stateData = ['Login' => 'Success'];
                     $state->addEntries($stateData);
 
                     //Store response state in session variable
                     $session->add("state", $state);

                     //Store user email in session
                     $session->add("Email", $userPOSTData['email']);

                    //Set post as profile for requestHandler
                    header("Location: index.php?Profile");
                    
                }
                else{

                    $errors['Errors'] = "Invalid email/password";
                    $this->view->addVar("Errors", $errors);

                    //Get ResponseHandler
                    $responseHandler = ResponseHandler::getInstance();
                    $responseHandler->storeErrorLogs();
                    $responseHandler->storeHeaders();
                    $state = $responseHandler->giveState();

                    //Make array with Profile in it
                    $stateData = ['Login' => 'Failure'];
                    $state->addEntries($stateData);

                    //Store response handler in session variable
                    $session->remove('state');
                    $session->add("state", $state);
                }

            }

            //Tell the model to update the data which changed
            $this->observableModel->updateChangedData($data);  
            
            //Tell the model to notify it's attached observers, pushing the updated data to them
            $this->observableModel->notify();
        
    }

    public function execute(CommandContext $context) : bool{

        $this->objectData = $context;
        $this->run();
        return true;
    
    }

}
?>