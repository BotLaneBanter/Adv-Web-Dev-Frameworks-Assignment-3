<?php 

namespace QuwisSystem\Framework;

class Logout{

  public function logOutUser()
{
    $registry = Registry::getInstance();
    $session = $registry->getSession();
    //$session->create();
    $session->remove('Email');
    //$session->destroy();
    header('Location: index.php');
}


}

?>