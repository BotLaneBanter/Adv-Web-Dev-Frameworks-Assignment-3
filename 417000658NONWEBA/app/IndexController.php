<?php 

namespace app\handlers;
use QuwisSystem\Framework\PageController_Command_Abstract;
use QuwisSystem\Framework\View;
use QuwisSystem\Framework\Observable_Model;
use QuwisSystem\Framework\CommandContext;
use QuwisSystem\Framework\Registry;


class IndexController extends PageController_Command_Abstract{

    private $objectData = null;

    public function run(){

               //Create and set the respective view and model objects
               $view = $this->makeView('Index');
               $model = $this->makeModel('Index');
               $this->setView($view);
               $this->setModel($model);

                //Establish a connection with the database
                $this->observableModel->makeConnection();

                //Attach the view to the observable_model so the view can recieve updates from it
                $this->observableModel->attach($this->view);
                //If data is needed from the model, get the array of data
                //(In this case it returns the sorted multi-dimensional array of popular/recommended courses)
                $data = $this->observableModel->findAll();
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