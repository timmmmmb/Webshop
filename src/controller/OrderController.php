<?php

require_once 'src/model/OrderModel.php';
require_once 'src/model/DefaultModel.php';
require_once 'src/lib/InputValidator.php';

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
        $iv = new InputValidator();
        $product_id = $iv->validateIntPost($_POST["product_id"], "product id");
        $amount = $iv->validateIntPost($_POST["amount"], "amount");
        $color = $iv->validateIntPost($_POST["color"], "color");
        $size = $iv->validateIntPost($_POST["size"], "size");
        $orderModel->addToBasket(
            $product_id,
            $_SESSION["user_id"],
            $amount,
            $color,
            $size
        );
        $_SESSION['user_order_count'] += $amount;
        echo $_SESSION['user_order_count'];
    }

    /**
     * https://servername/order/updateAmount
     */
    public function updateAmount()
    {
        $orderModel = new OrderModel();
        $iv = new InputValidator();
        $product_id = $iv->validateIntPost($_POST["id"], "product id");
        $amount = $iv->validateIntPost($_POST["amount"], "amount");
        $orderModel->changeProductAmount($amount, $product_id);
        $_SESSION['user_order_count'] = $orderModel->getNumberOfProductsInBasket($_SESSION["user_id"]);
        header("Location: /" . $_SESSION['lang']['name'] . "/basket");
        die();
    }

    /**
     * https://servername/order/removeItem
     * removes all of the items of one type from the basket and returns to the basket.
     */
    public function removeItem()
    {
        $orderModel = new OrderModel();
        $iv = new InputValidator();
        $id = $iv->validateIntPost($_POST["id"], "product id");
        $amount = $iv->validateIntPost($_POST["amount"], "amount");
        $orderModel->removeItemByID($id);
        $_SESSION['user_order_count'] -= $amount;
        header("Location: /" . $_SESSION['lang']['name'] . "/basket");
        die();
    }
}