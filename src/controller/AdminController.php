<?php

require_once 'src/model/UserModel.php';
require_once 'src/model/ProductModel.php';
require_once 'src/model/OrderModel.php';

/**
 * URL name: /admin
 * This controller is invoked at https://servername/admin/ by the Dispatcher.
 * The class methods are invoked at https://servername/admin/method by the Dispatcher.
 */
class AdminController
{
    /**
     * https://servername/admin
     */
    public function index()
    {
        $this->checkForAdminRights("/");
        $view = new View('admin');
        $view->title = 'Admin';
        $view->heading = 'Admin';
        $view->display();
    }

    /**
     * https://servername/admin/user
     */
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

    /**
     * https://servername/admin/product
     */
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

    /**
     * https://servername/admin/order
     */
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
    
    /**
     * Redirect if permission denied.
     * @param string $redirect.
     */
    private function checkForAdminRights($redirect)
    {
        if (isset($_SESSION['user_type']) && $_SESSION["user_type"] != "Admin") {
            header("Location: " . $redirect);
            die();
        }
    }
}