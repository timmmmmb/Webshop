<?php

require_once 'src/model/DefaultModel.php';

class DefaultController
{
    public function index() {
      
        $defaultModel = new DefaultModel();

        $view = new View('default_index');
        $view->title = 'Startseite';
        $view->heading = 'Startseite';
        $view->products = $defaultModel->readAll();
        $view->display();
    }
}
