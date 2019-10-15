<?php
require_once 'src/model/UserModel.php';
require_once 'src/model/ProductModel.php';
require_once 'src/model/OrderModel.php';

class AdminController
{
    public function index()
    {
        $this->checkForAdminRights("/");
        $view = new View('admin');
        $view->title = 'Admin';
        $view->heading = 'Admin';
        $view->display();
    }

    public function user()
    {
        $this->checkForAdminRights("/");
        $userModel = new UserModel();
        $view = new View('admin_user_list');
        $view->title = 'Admin';
        $view->heading = 'Admin';
        $view->users = $userModel->getAllUsers();
        $view->display();
    }

    public function product()
    {
        $this->checkForAdminRights("/");
        $productmodel = new ProductModel();
        $view = new View('admin_product_list');
        $view->title = 'Admin';
        $view->heading = 'Admin';
        $view->products = $productmodel->readAll();
        $view->display();
    }

    public function order()
    {
        $this->checkForAdminRights("/");
        $ordermodel = new OrderModel();
        $view = new View('admin_order_list');
        $view->title = 'Admin';
        $view->heading = 'Admin';
        $view->orders = $ordermodel->readAll();
        $view->display();
    }

    private function checkForAdminRights($redirect)
    {
        if (isset($_SESSION['user_type']) && $_SESSION["user_type"] != "Admin") {
            header("Location: " . $redirect);
            die();
        }
    }
}