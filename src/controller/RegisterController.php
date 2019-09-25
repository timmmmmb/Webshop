<?php

require_once 'src/model/RegisterModel.php';

class RegisterController
{
    public function index() {
      
        $registerModel = new RegisterModel();

        $view = new View('register');
        $view->title = 'Register';
        $view->heading = 'Register';
        $view->products = $registerModel->readAll();
        $view->display();
    }
}
