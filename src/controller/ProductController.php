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
        $productModel = new ProductModel();
        $view = new View('product_detail');
        $view->title = 'Product';
        $view->heading = 'Product';
        $iv = new InputValidator();
        $product_id = $iv->validateIntGet($_GET["product_id"], "product id");
        $view->product = $productModel->readById($product_id);
        $view->colors = $productModel->readColorsByID($product_id);
        $view->sizes = $productModel->readSizesByID($product_id);
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
        $ordermodel = new OrderModel();
        $ordermodel->payBasket($_SESSION["user_id"]);
        $_SESSION['user_order_count'] = 0;
        header("Location: /".$_SESSION['lang']['name']);
        die();
    }
}