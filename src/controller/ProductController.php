<?php

require_once 'src/model/ProductModel.php';
require_once 'src/model/OrderModel.php';
require_once 'src/lib/InputValidator.php';

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
            header("Location: /".$_SESSION['lang']['name']);
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
    public function checkout()
    {
        $ordermodel = new OrderModel();
        $view = new View('checkout');
        $view->title = 'Checkout';
        $view->heading = 'Checkout';
        $view->products = $ordermodel->getProductsInBasket($_SESSION["user_id"]);
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
                $street = $iv->validateByRegex($_POST['address_street'], "@^[a-zA-Z0-9]*+$@");
                $zip = $iv->validateByRegex($_POST['address_plz'], "@^[0-9]{4}+$@");
                $place = $iv->validateByRegex($_POST['address_place'], "@^[a-zA-Z0-9]*+$@");
                $cardname = $iv->validateByRegex($_POST['card_name'], "@^[a-zA-Z]*+$@");
                $cardnumber = $iv->validateByRegex($_POST['card_number'], "@^\d{4}\s\d{4}\s\d{4}\s\d{4}+$@");
                $cardcvv = $iv->validateByRegex($_POST['card_cvv'], "@^\d{3,4}+$@");
                $cardexp = $iv->validateByRegex($_POST['card_exp'], "@^\d{2}\.\d{4}+$@");
            }
            catch (Exception $e)
            {
                $response->status = 'error';
                $response->error = $e->getMessage();
                echo json_encode($response);
                exit();
            }
            
            $ordermodel = new OrderModel();
            $ordermodel->payBasket($_SESSION["user_id"]);
            $_SESSION['user_order_count'] = 0;

            $response->status = "success";
            $response->href = "/".$_SESSION['lang']['name'];
            echo json_encode($response);
        }
    }
}