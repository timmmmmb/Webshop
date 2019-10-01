<?php


class OrderController
{
    public function index() {

    }

    public function addBasket() {
        echo $_POST["product_id"];
        echo $_POST["color"];
        echo $_POST["size"];
        echo date_default_timezone_get();
    }
}