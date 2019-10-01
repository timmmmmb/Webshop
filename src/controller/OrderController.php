<?php

require_once 'src/model/OrderModel.php';
require_once 'src/model/DefaultModel.php';

class OrderController
{
    public function index() {

    }

    public function addBasket() {
        $productModel = new OrderModel();
        $productModel->addToBasket($_POST["product_id"], $_SESSION["user_id"],$_POST["amount"], $_POST["color"], $_POST["size"] );
        header("Location: /");
    }
}