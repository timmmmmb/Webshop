<?php
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

    private function checkForAdminRights($redirect)
    {
        if(isset($_SESSION['user_type'])&&$_SESSION["user_type"]!="Admin")
        {
            header("Location: " . $redirect);
            die();
        }
    }
}