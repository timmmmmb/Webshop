<?php
require_once 'src/model/ProductModel.php';

class ProductController
{
    public function index()
    {
        $productModel = new ProductModel();
        $view = new View('productDetail');
        $view->title = 'ProductView';
        $view->heading = 'ProductView';
        $view->product = $productModel->readById($_GET['product_id']);
        $view->colors = $productModel->readColorsByID($_GET['product_id']);
        $view->sizes = $productModel->readSizesByID($_GET['product_id']);
        $view->display();
    }
}

?>