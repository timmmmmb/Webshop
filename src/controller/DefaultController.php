<?php

require_once 'src/model/DefaultModel.php';

class DefaultController
{
    public function index() 
    {
        $defaultModel = new DefaultModel();
        $view = new View('default_index');
        $view->title = 'Home';
        $view->heading = 'Home';
        $view->products = $defaultModel->readAll();
        $view->display();
    }
}
?>