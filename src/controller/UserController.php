<?php

require_once 'src/model/UserModel.php';
require_once 'src/model/OrderModel.php';
require_once 'src/helper/InputValidation.php';

/**
 * URL name: /user
 * This controller is invoked at https://servername/user/ by the Dispatcher.
 * The class methods are invoked at https://servername/user/method by the Dispatcher.
 */
class UserController
{
    /**
     * https://servername/user
     */
    public function index() 
    {
        $this->profile();
    }

    /**
     * https://servername/user/profile
     */
    public function profile() 
    {
        if(!isset($_SESSION['user_id'])) 
        {
            header("Location: /".$_SESSION['lang']['name']."/user/login");
            die();
        }
        $userModel = new UserModel();
        $view = new View('profile');
        $view->title = 'Profile';
        $view->heading = 'Profile';
        $view->user = $userModel->readById($_SESSION['user_id']);
        $view->display();
    }

    /**
     * https://servername/user/register
     */
    public function register() 
    {
        $this->checkForExistingLogin("/".$_SESSION['lang']['name']);
        $view = new View('register');
        $view->title = 'Register';
        $view->heading = 'Register';
        $view->display();
    }

    /**
     * https://servername/user/doRegister
     */
    public function doRegister() 
    {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['psw'])) 
        {
            $userModel = new UserModel();
            $iv = new InputValidation();
            $name = $iv->nameInputValidationPost($_POST['name'], "Name");
            $email = $iv->emailInputValidationPost($_POST['email'], "email");
            $psw = $iv->passwordInputValidationPost($_POST['psw'], "Password");
            if ($userModel->userExists(
                $name,
                $email))
            {
                $userModel->createUser(
                    $name,
                    $email,
                    $psw,
                    '1'
                );
                $this->doLogin();
            } 
            else 
            {
                $data = new stdClass();
                $data->status = "error";
                echo json_encode($data);
            }
        }
    }

    /**
     * https://servername/user/login
     */
    public function login() 
    {
        $this->checkForExistingLogin("/".$_SESSION['lang']['name']."/user/profile");
        $view = new View('login');
        $view->title = 'Login';
        $view->heading = 'Login';
        $view->display();
    }

    /**
     * https://servername/user/doLogin
     */
    public function doLogin() 
    {
        $userModel = new UserModel();
        $iv = new InputValidation();
        $name = $iv->nameInputValidationPost($_POST['name'], "Name");
        $psw = $iv->passwordInputValidationPost($_POST['psw'], "Password");
        $result = $userModel->getUserByNameAndPassword(
            $name,
            $psw
        );
        $arr = (array)$result;
        $data = new stdClass();

        if(empty($arr)) 
        {
            $data->status = "error";
        } 
        else 
        {
            $orderModel = new OrderModel();
            $_SESSION['user_order_count'] = $orderModel->getNumberOfProductsInBasket($result->ID);
            $_SESSION['user_id'] = $result->ID;
            $_SESSION['user_name'] = $result->Name;
            $_SESSION['user_type_de'] = $result->Type_de;
            $_SESSION['user_type_en'] = $result->Type_en;
            $data->status = "success";
            $data->href = "/".$_SESSION['lang']['name'];
        }
        echo json_encode($data);
    }

    /**
     * https://servername/user/logout
     */
    public function logout() 
    {
        $lang = $_SESSION['lang']['name'];
        session_unset();
        header("Location: /".$lang);
        die();
    }

    /**
     * Deny access to certain pages if user is not logged in.
     */
    private function checkForExistingLogin($redirect) 
    {
        if(isset($_SESSION['user_id'])) 
        {
            header("Location: " . $redirect);
            die();
        }
    }
}