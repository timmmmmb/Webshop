<?php

require_once 'src/model/UserModel.php';
require_once 'src/model/OrderModel.php';
require_once 'src/lib/InputValidator.php';

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
        $this->redirectIfSessionIs(false, _ROOT.$_SESSION['lang']['name']."/user/login");
        $userModel = new UserModel();
        $orderModel = new OrderModel();
        $view = new View('profile');
        $view->title = 'Profile';
        $view->heading = 'Profile';
        $view->user = $userModel->readById($_SESSION['user_id']);
        $view->orders = $orderModel->getAllBoughtProducts($_SESSION['user_id'], 'Bought');
        $view->display();
    }

    /**
     * https://servername/user/doEdit
     */
    public function doEdit() 
    {
        if (isset($_POST['email'])) 
        {
            $iv = new InputValidator();
            $email = $iv->validateEmail($_POST['email']);
            $userModel = new UserModel();
            $userModel->updateUserEmail($email, $_SESSION['user_id']);
        }
    }

    /**
     * https://servername/user/register
     */
    public function register() 
    {
        $this->redirectIfSessionIs(true, _ROOT.$_SESSION['lang']['name']);
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
        if (isset($_POST['name']) && 
            isset($_POST['email']) && 
            isset($_POST['psw']) && 
            isset($_POST['psw-repeat'])) 
        {
            $userModel = new UserModel();
            $iv = new InputValidator();
            $response = new stdClass();

            try
            {
                $name = $iv->validateUsername($_POST['name']);
                $email = $iv->validateEmail($_POST['email']);
                $psw = $iv->validatePassword($_POST['psw'], $_POST['psw-repeat']);
            }
            catch (Exception $e)
            {
                $response->status = "error";
                $response->error = $e->getMessage();
                echo json_encode($response);
                exit();
            }

            if ($userModel->userDoesNotExists($name, $email))
            {
                $userModel->createUser($name, $email, $psw, '1');
                $this->doLogin();
            } 
            else 
            {
                $response->status = "error";
                $response->error = _REGISTER_ERROR;
                echo json_encode($response);
                exit();
            }
        }
    }

    /**
     * https://servername/user/login
     */
    public function login() 
    {
        $this->redirectIfSessionIs(true, _ROOT.$_SESSION['lang']['name']."/user/profile");
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
        $iv = new InputValidator();
        $response = new stdClass();

        try 
        {
            $name = $iv->validateString($_POST['name']);
            $psw = $iv->validateString($_POST['psw']);
            $psw = md5($psw);
            $result = $userModel->getUserByNameAndPassword($name, $psw);
        }
        catch (Exception $e)
        {
            $response->status = "error";
            $response->error = $e->getMessage();
            echo json_encode($response);
            exit();
        }

        $arr = (array)$result;
        
        if (empty($arr)) 
        {
            $response->status = "error";
            $response->error = _LOGIN_ERROR;
        } 
        else 
        {
            $orderModel = new OrderModel();
            $_SESSION['user_order_count'] = $orderModel->getNumberOfProductsInBasket($result->ID);
            $_SESSION['user_id'] = $result->ID;
            $_SESSION['user_name'] = $result->Name;
            $_SESSION['user_type'] = $result->Type_en;
            $response->status = "success";
            $response->href = _ROOT.$_SESSION['lang']['name'];
        }
        echo json_encode($response);
    }

    /**
     * https://servername/user/logout
     */
    public function logout() 
    {
        $lang = $_SESSION['lang']['name'];
        session_unset();
        header("Location: "._ROOT.$lang);
        die();
    }

    /**
     * Deny access to certain pages if user is not logged in.
     * @param string $redirect.
     */
    private function redirectIfSessionIs($bool, $redirect) 
    {
        if (isset($_SESSION['user_id']) == $bool) 
        {
            header("Location: ".$redirect);
            die();
        }
    }
}