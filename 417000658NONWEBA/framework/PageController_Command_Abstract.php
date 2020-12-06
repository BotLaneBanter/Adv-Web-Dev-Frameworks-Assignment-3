<?php 

namespace QuwisSystem\Framework;
use QuwisSystem\Framework\View;

abstract class PageController_Command_Abstract{

protected $observableModel = null;
protected $view = null;
    
public function setModel(Observable_Model $m){
    
    $this->observableModel = $m;
    
}
    
public function setView(View $v){
    
     $this->view = $v;
    
}

public function makeView(string $tpl) : View{

    //Set the webpage template to be displayed
    $v = new View();
    if(empty($tpl)){

        throw new CommandNotFoundException("A Template Name Must Be Given");

    }

    $v->setTemplate(TPL_DIR . '\\' . strtolower($tpl) . '.tpl.php');
    return $v;

}

public function makeModel(string $model)  : Observable_Model{

    if (preg_match('/\W/', $model)) {

        throw new Exception("Illegal Characters In Action");

        }

        if(empty($model)){

            throw new CommandNotFoundException("A Model Name Must Be Specified");

        }
       
        $class = "app\\handlers\\" . UCFirst(strtolower($model)) . "Model";
        
        if (! class_exists($class)) {
       
            throw new CommandNotFoundException("No Model Class: '$class' Located");
      
        }
       
        $modelObject = new $class();

    return $modelObject;

} 

abstract public function run();

abstract public function execute(CommandContext $context) : bool;


}

?>