<?php 

namespace app\handlers;
use QuwisSystem\Framework\PageController_Command_Abstract;
use QuwisSystem\Framework\Validator;
use QuwisSystem\Framework\View;
use QuwisSystem\Framework\CommandContext;
use QuwisSystem\Framework\Registry;
use SignupModel;

class SignupController extends PageController_Command_Abstract{

    private $objectData = null;

    public function run(){

        //Creates and sets the respective view and model objects
        $view = $this->makeView('Signup');
        $model = $this->makeModel('SignUp');
        $this->setView($view);
        $this->setModel($model);
    
        //Establish a connection with the database
        $this->observableModel->makeConnection();

        //Attach the view to the observable_model so the view can recieve updates from it
        $this->observableModel->attach($this->view);
        //If data is needed from the model, get the array of data
        //(In this case it returns the sorted multi-dimensional array of popular/recommended courses)
        $data = $this->observableModel->findAll();

        //Error variable
        $errorExists = false;

        //Check if the register button was clicked
        if(isset($_POST['SignUp'])){      

            //Get instance of registry then get validator
            $registry = Registry::getInstance();
            $validate = $registry->getValidator();

            //POSTED user array from CommandContext
            $userPOSTData = $this->objectData->get('post');

            $userRecord = $this->observableModel->findRecord($userPOSTData['email']);
            $hashedPassword = "";
            $hashedPassword = $userRecord['users']['Password'];

            //Get user record
            $userData = $this->observableModel->findRecord($_POST['email']);

            $validate->isEmailValid($userPOSTData['email']);
            $validate->isPasswordValid($userPOSTData['password']);
                
                //Check the full name isn't empty
                if(empty($userPOSTData['formFullName'])){
                    $fullNameError['Errors'] = "Please Enter Your Name";
                    $this->view->addVar("Errors", $fullNameError);
                    $errorExists = true;
                }
                //Check a valid email was entered
                else if($validate->getErrorEmailThrown()){
                    $emailError['Errors'] = "Invalid Email";
                    $this->view->addVar("Errors", $emailError);
                    $errorExists = true;
                }
                //Check a valid password was entered
                else if($validate->getErrorPasswordThrown()){
                    $passwordError['Errors'] = "Invalid Password";
                    $this->view->addVar("Errors", $passwordError);
                    $errorExists = true;
                }
                //Check the password matches the retyped password
                else if(($userPOSTData['password']) != ($userPOSTData['retypedPassword'])){
                    $mismatchError['Errors'] = "Passwords Do Not Match";
                    $this->view->addVar("Errors", $mismatchError);
                    $errorExists = true;
                }
                //Check the terms checkbox was ticked
                else if(!isset($userPOSTData['termsCheckbox'])){
                    $termsError['Errors'] = "Please Read And Accept The Terms";
                    $this->view->addVar("Errors", $termsError);
                    $errorExists = true;
                }
                //Check the users email isn't already in use
                else if($userPOSTData['email'] == $userData['users']['Email']){
                    $termsError['Errors'] = "Account Already Exists";
                    $this->view->addVar("Errors", $termsError);
                    $errorExists = true;
                }
                //If successful, run the loginController
                else if( (!$validate->getErrorEmailThrown()) && (!$validate->getErrorPasswordThrown())){

                    //Successful Sign Up Message
                    $successfulSignUp['successfulSignUp'] = "Sign Up Successful. Please login below";

                    //User data to be stored
                    $signUpData = ['name' => $userPOSTData['formFullName'], 'email' => $userPOSTData['email'], 'password' => $userPOSTData['password']];

                    //Insert the data using the trait insert function
                    $this->observableModel->insert($signUpData);

                    //Tell the model to update the data which changed
                    $this->observableModel->updateChangedData($data);  
                        
                    //Tell the model to notify it's attached observers, pushing the updated data to them
                    $this->observableModel->notify();

                    //Set post as profile for requestHandler
                    header("Location: index.php?Login");

                }
                    
                if($errorExists == true){
                    //Tell the model to update the data which changed
                    $this->observableModel->updateChangedData($data);  
                        
                    //Tell the model to notify it's attached observers, pushing the updated data to them
                    $this->observableModel->notify();
                }

        }//End of POST check
        else{

            //Tell the model to update the data which changed
            $this->observableModel->updateChangedData($data);  
                
            //Tell the model to notify it's attached observers, pushing the updated data to them
            $this->observableModel->notify();
    }
    
}//End of run()

public function execute(CommandContext $context) : bool{

    $this->objectData = $context;
    $this->run();
    return true;

}

}
?>