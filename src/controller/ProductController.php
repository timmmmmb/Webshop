<?php
require_once 'src/model/ProductModel.php';
require_once 'src/model/OrderModel.php';

class ProductController
{
    public function index()
    {
        $productModel = new ProductModel();
        $view = new View('product_detail');
        $view->title = 'Product';
        $view->heading = 'Product';
        $view->product = $productModel->readById($_GET['product_id']);
        $view->colors = $productModel->readColorsByID($_GET['product_id']);
        $view->sizes = $productModel->readSizesByID($_GET['product_id']);
        $view->display();
    }

    public function payForm()
    {
        $view = new View('pay');
        $view->title = 'Payment';
        $view->heading = 'Payment';
        $ordermodel = new OrderModel();
        $view->products =$ordermodel->getProductsInBasket($_SESSION["user_id"]);
        $view->display();
    }

    public function pay() 
    {
        //Just change the state of the order
        $ordermodel = new OrderModel();
        $ordermodel->payBasket($_SESSION["user_id"]);
        $_SESSION['user_order_count'] = 0;
        header("Location: /");
    }
}

?>