<?php

require_once 'src/model/OrderModel.php';
require_once 'src/model/DefaultModel.php';

/**
 * URL name: /order
 * This controller is invoked at https://servername/order/ by the Dispatcher.
 * The class methods are invoked at https://servername/order/method by the Dispatcher.
 * 
 */
class OrderController
{
    /**
     * https://servername/order/addBasket
     */
    public function addBasket() 
    {
        $orderModel = new OrderModel();
        $orderModel->addToBasket(
            $_POST["product_id"], 
            $_SESSION["user_id"],
            $_POST["amount"], 
            $_POST["color"], 
            $_POST["size"]
        );
        $_SESSION['user_order_count'] += $_POST["amount"];
        echo $_SESSION['user_order_count'];
    }

    /**
     * https://servername/order/updateAmount
     */
    public function updateAmount()
    {
        $orderModel = new OrderModel();
        $orderModel ->changeProductAmount($_POST["amount"], $_POST["id"]);
        $_SESSION['user_order_count'] = $orderModel->getNumberOfProductsInBasket($_SESSION["user_id"]);
        header("Location: /".$_SESSION['lang']['name']."/basket");
        die();
    }

    /**
     * https://servername/order/removeItem
     * removes all of the items of one type from the basket and returns to the basket.
     */
    public function removeItem()
    {
        $orderModel = new OrderModel();
        $orderModel->removeItemByID($_POST["id"]);
        $_SESSION['user_order_count'] -= $_POST["amount"];
        header("Location: /".$_SESSION['lang']['name']."/basket");
        die();
    }
}