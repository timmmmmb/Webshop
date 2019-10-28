<?php

require_once 'src/model/OrderModel.php';

/**
 * URL name: /basket
 * This controller is invoked at https://servername/basket/ by the Dispatcher.
 * The class methods are invoked at https://servername/basket/method by the Dispatcher.
 */
class BasketController
{
    /**
     * https://servername/basket
     */
    public function index() 
    {
        $ordermodel = new OrderModel();
        $view = new View('basket');
        $view->title = 'Warenkorb';
        $view->heading = 'Warenkorb';
        $view->products = $ordermodel->getProductsInBasket($_SESSION["user_id"]);
        $view->display();
    }
}