<?php

require_once 'src/model/UserModel.php';

class UserController
{
    public function index() {

        $view = new View('register');
        $view->title = 'Register';
        $view->heading = 'Register';
        $view->display();
    }

    public function register(){

        $view = new View('register');
        $view->title = 'Register';
        $view->heading = 'Register';
        $view->display();
    }

    public function doRegister() {

        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['psw'])) {
            
            $userModel = new UserModel();
            $userModel->createUser(
                htmlspecialchars($_POST['name']), 
                htmlspecialchars($_POST['email']), 
                md5(htmlspecialchars($_POST['psw'])),
                '1'
            );
        }
    }
}
