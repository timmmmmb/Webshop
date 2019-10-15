<?php

require_once 'src/model/DefaultModel.php';

class DefaultController
{
    public function index() 
    {
        if(isset($_POST['lang']))
        {
            $_SESSION['lang'] = $_POST['lang'];
            $_POST = array();
        }   
        $defaultModel = new DefaultModel();
        $view = new View('default_index');
        $view->title = 'Home';
        $view->heading = 'Home';
        $view->products = $defaultModel->readAll();
        $view->display();
    }
}
?>