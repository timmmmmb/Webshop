<?php

require_once 'src/model/UserModel.php';

class UserController
{
    public function index() 
    {
        $this->profile();
    }

    public function profile() 
    {
        if(!isset($_SESSION['user_id'])) 
        {
            header("Location: /user/login");
            die();
        }
        $userModel = new UserModel();
        $view = new View('profile');
        $view->title = 'Profile';
        $view->heading = 'Profile';
        $view->user = $userModel->readById($_SESSION['user_id']);
        $view->display();
    }

    public function register() 
    {
        $this->checkForExistingLogin();
        $view = new View('register');
        $view->title = 'Register';
        $view->heading = 'Register';
        $view->display();
    }

    public function doRegister() 
    {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['psw'])) 
        {
            $userModel = new UserModel();
            if ($userModel->checkIfUserExists(
                htmlspecialchars($_POST['name']),
                htmlspecialchars($_POST['email']))
            ) {
                $userModel->createUser(
                    htmlspecialchars($_POST['name']),
                    htmlspecialchars($_POST['email']),
                    md5(htmlspecialchars($_POST['psw'])),
                    '1'
                );
                $this->doLogin();
            } 
            else 
            {
                echo 'registration__failed';
            }
        }
    }

    public function login() 
    {
        $this->checkForExistingLogin();
        $view = new View('login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function doLogin() 
    {
        $userModel = new UserModel();
        $result = $userModel->getUserByNameAndPassword(htmlspecialchars($_POST['name']), md5(htmlspecialchars($_POST['psw'])));
        $arr = (array)$result;
        
        if(empty($arr)) 
        {
            echo "login__failed";
        } 
        else 
        {
            $_SESSION['user_id'] = $result->ID;
            $_SESSION['user_name'] = $result->Name;
            echo "login__success";
        }
    }

    public function logout() 
    {
        session_unset();
        header("Location: /");
        die();
    }

    private function checkForExistingLogin() 
    {
        if(isset($_SESSION['user_id'])) 
        {
            header("Location: /");
            die();
        }
    }

}
