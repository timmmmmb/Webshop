<?php

require_once 'src/model/OrderModel.php';
require_once 'src/model/DefaultModel.php';

class OrderController
{
    public function index() {

    }

    public function addBasket() {
        $orderModel = new OrderModel();
        $orderModel->addToBasket($_POST["product_id"], $_SESSION["user_id"],$_POST["amount"], $_POST["color"], $_POST["size"] );
        header("Location: /");
    }

    public function updateAmount(){
        $orderModel = new OrderModel();
        $orderModel ->changeProductAmount($_POST["amount"],$_POST["id"]);
        header("Location: /basket");
    }

    /*
     * removes all of the items of one type from the basket and returns to the basket.
     */
    public function removeItem(){
        $orderModel = new OrderModel();
        $orderModel->removeItemByID($_POST["id"]);
        header("Location: /basket");
    }
}