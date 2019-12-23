<?php

require_once 'src/model/UserModel.php';
require_once 'src/model/ProductModel.php';
require_once 'src/model/OrderModel.php';
require_once 'src/lib/InputValidator.php';

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
     * https://servername/admin/createproduct
     */
    public function createProduct()
    {
        $this->checkForAdminRights("/");
        if (
            isset($_POST['name_de']) && 
            isset($_POST['name_en']) &&
            isset($_POST['description_de']) &&
            isset($_POST['description_en']) &&
            isset($_POST['gender']) &&
            isset($_POST['price']) &&
            isset($_FILES['image']))
        {
            $iv = new InputValidator();
            $productModel = new ProductModel();
            try
            {
                $name_de = $iv->validateString($_POST['name_de']);
                $name_en = $iv->validateString($_POST['name_en']);
                $description_de = $iv->validateString($_POST['description_de']);
                $description_en = $iv->validateString($_POST['description_en']);
                $price = $iv->validateByRegex($_POST['price'], "@^\d+\.\d+$@");
                $gender = $_POST['gender'];
                $image = $_FILES['image'];
            }
            catch (\Exception $e)
            {
                echo $e->getMessage();
                die();
            }
            
            $target_dir = "src/view/images/";
            $target_file = $target_dir . basename($image["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            //Check if file already exists
            if (file_exists($target_file)) 
            {
                echo "Sorry, file already exists.";
                die();
            }
            //Allow certain file formats
            if ($imageFileType != "png") 
            {
                echo "Sorry, only PNG files are allowed.";
                die();
            }
            //Allow specific size
            $imageSize = getimagesize($image["tmp_name"]);
            if ($imageSize[0] != $imageSize[1])
            {
                echo "Sorry, image must have same width as height";
                die();
            }
            //Upload
            if (move_uploaded_file($image["tmp_name"], $target_file)) 
            {
                $imageName = basename($image["name"]);
                echo "The file ". $imageName . " has been uploaded.";
                $productModel->insertProduct(
                    $name_de, 
                    $name_en, 
                    $description_de, 
                    $description_en, 
                    $gender, 
                    $imageName, 
                    $price);
            } 
            else 
            {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    
    /**
     * Redirect if permission denied.
     * @param string $redirect.
     */
    private function checkForAdminRights($redirect)
    {
        if (!isset($_SESSION['user_type'])) 
        {
            header("Location: ".$redirect);
            die();
        }
        else
        {
            if ($_SESSION["user_type"] != "Admin") 
            {
                header("Location: ".$redirect);
                die();
            }
        }
    }
}