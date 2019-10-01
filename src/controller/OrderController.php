<?php

require_once 'src/model/OrderModel.php';
require_once 'src/model/DefaultModel.php';

class OrderController
{
    public function index() {

    }

    public function addBasket() {
        $productModel = new OrderModel();
        $defaultModel = new DefaultModel();
        $productModel->addToBasket($_POST["product_id"], $_SESSION["user_id"],$_POST["amount"], $_POST["color"], $_POST["size"] );
        $view = new View('default_index');
        $view->title = 'Startseite';
        $view->heading = 'Startseite';
        $view->products = $defaultModel->readAll();
        $view->display();
    }
}