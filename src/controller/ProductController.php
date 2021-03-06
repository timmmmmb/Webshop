<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'src/model/ProductModel.php';
require_once 'src/model/OrderModel.php';
require_once 'src/model/UserModel.php';
require_once 'src/lib/InputValidator.php';
require_once 'src/lib/phpmailer/PHPMailer.php';
require_once 'src/lib/phpmailer/Exception.php';
require_once 'src/lib/phpmailer/SMTP.php';

/**
 * URL name: /product
 * This controller is invoked at https://servername/product/ by the Dispatcher.
 * The class methods are invoked at https://servername/product/method by the Dispatcher.
 */
class ProductController
{
    /**
     * https://servername/product
     */
    public function index()
    {
        if(!isset($_GET["product_id"]))
        {
            header("Location: "._ROOT.$_SESSION['lang']['name']);
            die();
        }
        $productModel = new ProductModel();
        $view = new View('product_detail');
        $view->title = 'Product';
        $view->heading = 'Product';
        $iv = new InputValidator();
        $product_id = $iv->validateIntGet($_GET["product_id"]);
        $view->product = $productModel->readById($product_id);
        $view->colors = $productModel->readColorsByID($product_id);
        $view->sizes = $productModel->readSizesByID($product_id);
        $view->display();
    }

    /**
     * https://servername/product/men
     */
    public function men()
    {
        $productModel = new ProductModel();
        $view = new View('default_index');
        $view->title = _MEN;
        $view->heading = _MEN;
        $view->banner = 'banner_men.jpg';
        $view->products = $productModel->getProductsBySex("Male");
        $view->display();
    }

    /**
     * https://servername/product/men
     */
    public function women()
    {
        $productModel = new ProductModel();
        $view = new View('default_index');
        $view->title = _WOMEN;
        $view->heading = _WOMEN;
        $view->banner = 'banner_women.jpg';
        $view->products = $productModel->getProductsBySex("Female");
        $view->display();
    }

    /**
     * https://servername/product/checkout
     */
    public function search()
    {
        if (isset($_GET['q']))
        {
            $productModel = new ProductModel();
            $iv = new InputValidator();
            $query = $iv->validateStringGet($_GET["q"]);
            $view = new View('default_index');
            $view->title = _SEARCH;
            $view->products = $productModel->searchProducts($query);
            $view->display();
        }
        else
        {
            header("Location: "._ROOT.$_SESSION['lang']['name']);
            die();
        }
    }

    /**
     * https://servername/product/checkout
     */
    public function checkout()
    {
        $orderModel = new OrderModel();
        $basketid = $orderModel->getBasketID($_SESSION["user_id"]);
        $products = $orderModel->getProductsInBasket($basketid);
        if(empty($products))
        {
            header("Location: "._ROOT.$_SESSION['lang']['name']);
            die();
        }
        $view = new View('checkout');
        $view->title = 'Checkout';
        $view->heading = 'Checkout';
        $view->products = $products;
        $view->display();
    }

    /**
     * https://servername/product/pay
     * Just change the state of the order
     */
    public function pay() 
    {
        if (isset($_POST['address_street']) &&
            isset($_POST['address_plz']) &&
            isset($_POST['address_place']) &&
            isset($_POST['card_name']) &&
            isset($_POST['card_number']) &&
            isset($_POST['card_cvv']) &&
            isset($_POST['card_exp']))
        {
            $response = new stdClass();

            try
            {
                $iv = new InputValidator();
                $street = $iv->validateByRegex($_POST['address_street'], "@^[a-zA-Z0-9_ ]*+$@");
                $zip = $iv->validateByRegex($_POST['address_plz'], "@^[0-9]{4}+$@");
                $place = $iv->validateByRegex($_POST['address_place'], "@^[a-zA-Z0-9]*+$@");
                $cardname = $iv->validateByRegex($_POST['card_name'], "@^[a-zA-Z]*+$@");
                $cardnumber = $iv->validateByRegex($_POST['card_number'], "@^\d{4}\s\d{4}\s\d{4}\s\d{4}+$@");
                $cardcvv = $iv->validateByRegex($_POST['card_cvv'], "@^\d{3,4}+$@");
                $cardexp = $iv->validateByRegex($_POST['card_exp'], "@^\d{2}\.\d{4}+$@");
            }
            catch (\Exception $e)
            {
                $response->status = 'error';
                $response->error = $e->getMessage();
                echo json_encode($response);
                exit();
            }

            //SEND MAIL
            $usermodel = new UserModel();
            $user = $usermodel->readById($_SESSION['user_id']);
            $config = require 'config.php';
            $username = $config['gmail']['username'];
            $password = $config['gmail']['password'];

            $mail = new PHPMailer();  
            $mail->isSMTP();                           
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;           
            $mail->Username = $username;                 
            $mail->Password = $password;     
            $mail->SMTPSecure = "tls";  
            $mail->Port = 587;                                   
            $mail->From = "tandy.webshop@gmail.com";
            $mail->FromName = "Tim and Yannick | Webshop";
            $mail->addAddress($user->EMail, $user->Name);
            $mail->isHTML(true);
            $mail->Subject = _MAIL_SUBJECT;
            ob_start();
            include('src/view/mail_content.php');
            $mail->Body = ob_get_clean();
            $mail->AltBody = _MAIL_ALTBODY;

            if($mail->send())
            {
                //PAY
                $ordermodel = new OrderModel();
                $ordermodel->payBasket($_SESSION["user_id"]);
                $_SESSION['user_order_count'] = 0;

                //MAIL SUCCESS
                $response->status = "success";
                $response->href = _ROOT.$_SESSION['lang']['name'];
            }
            else
            {
                //MAIL ERROR
                $response->status = "failed";
                $response->error = $mail->ErrorInfo;
            }
            echo json_encode($response);
        }
    }
}