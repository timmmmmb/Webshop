<?php

require_once 'src/model/UserModel.php';

class UserController
{
    public function index()
    {
        $this->profile();
    }

    public function register()
    {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['psw'])) {
            //check if that user allready exists
            $userModel = new UserModel();
            if ($userModel->checkIfUserExists(
                htmlspecialchars($_POST['name']),
                htmlspecialchars($_POST['email'])
            )) {
                $userModel->createUser(
                    htmlspecialchars($_POST['name']),
                    htmlspecialchars($_POST['email']),
                    md5(htmlspecialchars($_POST['psw'])),
                    '1'
                );
                $view = new View('register');
                $this->doLogin();
            }else{
                $view = new View('registerForm');
                echo 'unable to register user';
            }
        }


        $view->title = 'Register';
        $view->heading = 'Register';
        $view->display();
    }

    public function login()
    {
        if($this->doLogin()){
            $view = new View('login');
        }else{
            $view = new View('loginForm');
            echo "The login failed";
        }
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function doLogin(){
        $userModel = new UserModel();
        $result = $userModel->getUserByNameAndPassword(htmlspecialchars($_POST['name']),md5(htmlspecialchars($_POST['psw'])));
        //check if it was empty
        $arr = (array)$result;
        if (empty($arr)) {

            return false;
        }else{
            $_SESSION['user_id'] = $result->ID;
            $_SESSION['user_name'] = $result->Name;
            return true;
        }
    }

    public function loginForm()
    {
        $view = new View('loginForm');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    public function registerForm()
    {
        $view = new View('registerForm');
        $view->title = 'Register';
        $view->heading = 'Register';
        $view->display();
    }

    public function profile(){
        $view = new View('profile');
        $view->title = 'Profile';
        $view->heading = 'Profile';
        $view->display();
    }

    public function logout(){
        session_unset();
        $this->profile();
    }

}
