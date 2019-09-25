<?php

require_once 'src/model/UserModel.php';

class UserController
{
    public function index() {
      
        $registerModel = new UserModel();

        $view = new View('register');
        $view->title = 'Register';
        $view->heading = 'Register';
        $view->products = $registerModel->readAll();
        $view->display();
    }

    public function register(){
        $registerModel = new UserModel();

        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['psw'])) {
            echo "Successfully created a new user";
            $registerModel->createUser(htmlspecialchars($_POST['name']), htmlspecialchars($_POST['email']), md5(htmlspecialchars($_POST['psw'])));
        }

        $view = new View('register');
        $view->title = 'Register';
        $view->heading = 'Register';
        $view->products = $registerModel->readAll();
        $view->display();
    }
}
