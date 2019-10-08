<?php

require_once 'src/model/OrderModel.php';

class BasketController
{
    public function index() {
        $ordermodel = new OrderModel();
        $view = new View('basket');
        $view->title = 'Warenkorb';
        $view->heading = 'Warenkorb';
        $view->products =$ordermodel->getProductsInBasket($_SESSION["user_id"]);
        $view->basketisempty = $ordermodel->checkIfBasketEmptyByUser($_SESSION["user_id"]);
        $view->display();
    }
}