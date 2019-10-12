<?php

require_once 'src/lib/Model.php';

/**
 * Retrieves all order related data form database.
 */
class OrderModel extends Model
{
    protected $tableName = "orders";

    /**
     * Adds a new product to the basket of the user.
     * @param product_id id of product.  
     * @param user_id id of user.
     * @param amount amount of this product.
     * @param color_id color.
     * @param size_id size.
     * @throws Exception if database connection fails.
     */
    public function addToBasket($product_id, $user_id, $amount, $color_id, $size_id)
    {
        //Get the id of the order that represents the basket
        $basket_id = $this->getBasketID($user_id);
        //Create a new basket if there is none in the db
        if ($basket_id == 0) 
        {
            $this->createBasket($user_id);
            $basket_id = $this->getBasketID($user_id);
        }

        //Check if product is allready in basket
        $order_id = $this->checkIfProductAllreadyInBasket($product_id, $user_id, $color_id, $size_id, $basket_id);
        if ($order_id == 0) 
        {
            //Add product to the basket
            $query = "INSERT INTO orders_products (productid, orderid, amount, sizeid, colorid) VALUES (?, ?, ?, ?, ?)";

            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('iiiii', $product_id, $basket_id, $amount, $size_id, $color_id);

            if (!$statement->execute()) 
            {
                throw new Exception($statement->error);
            }
        } 
        else 
        {
            $this->addProductAmount($amount, $order_id);
        }
    }

    /**
     * Gets the basket id of the user specified.
     * @param user_id the id of the user.
     * @throws Exception if database connection fails.
     * @return int id of order.
     */
    private function getBasketID($user_id)
    {
        $query = 
            "SELECT * FROM orders WHERE userid = ? 
            AND stageid = (SELECT ID FROM stages WHERE NAME LIKE 'Warenkorb' LIMIT 1)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $user_id);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) 
        {
            throw new Exception($statement->error);
        }
        if (mysqli_num_rows($result) == 0) 
        {
            return 0;
        }
        $row = $result->fetch_object();
        $result->close();
        return $row->ID;
    }

    /**
     * Create a new order for the user where with the stage set to basket.
     * @param user_id id of user.
     * @throws Exception if database connection fails.
     */
    private function createBasket($user_id)
    {
        $query = "INSERT INTO orders (userID, stageID) VALUES (?, 1)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $user_id);

        if (!$statement->execute())
        {
            throw new Exception($statement->error);
        }
    }

    /**
     * Retrieve list of products in order.
     * @param user_id id of user.
     * @throws Exception if database connection fails.
     * @return Array of products
     */
    public function getProductsInBasket($user_id)
    {
        $basketid = $this->getBasketID($user_id);
        $query =
            "SELECT
                p.id as ID,
                p.name as name,
                p.preis as prize,
                p.image as image,
                CONVERT(p.preis * sum(amount), DECIMAL(65, 2)) as total_prize,
                sum(amount) as amount,
                c.Name as color,
                s.name as size,
                op.ID as order_id
            FROM orders_products as op
                JOIN products p ON op.ProductID = p.ID
                JOIN colors c ON op.ColorID = c.ID
                JOIN sizes s ON op.SizeID = s.ID
            WHERE OrderID = ?
            GROUP BY NAME, color, size";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $basketid);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) 
        {
            throw new Exception($statement->error);
        }

        $rows = array();
        while ($row = $result->fetch_object()) 
        {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Gets number of individual orders.
     * @param user_id id of user.
     * @return int order count.
     */
    public function getNumberOfProductsInBasket($user_id) 
    {
        $products = $this->getProductsInBasket($user_id);
        $numberOfProducts = 0;
        foreach($products as $product)
        {
            $numberOfProducts += $product->amount;
        }
        return $numberOfProducts;
    }

    /**
     * Remove entry in basket.
     * @param id of order.
     * @throws Exception if database connection fails.
     */
    public function removeItemByID($id)
    {
        $query = "DELETE FROM orders_products where id = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        if (!$statement->execute()) 
        {
            throw new Exception($statement->error);
        }
    }

    /**
     * Update amount of product order.
     * @param amount new amount.
     * @param id id of order.
     * @throws Exception if database connection fails.
     */
    public function changeProductAmount($amount, $id)
    {
        $query = "UPDATE orders_products SET amount = ? WHERE ID = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $amount, $id);

        if (!$statement->execute()) 
        {
            throw new Exception($statement->error);
        }
    }

    /**
     * Increases the amount of an order.
     * @param amount amount increment.
     * @param id id of order.
     * @throws Exception if database connection fails.
     */
    public function addProductAmount($amount, $id)
    {
        $query = "UPDATE orders_products SET amount = amount + ? WHERE ID = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $amount, $id);

        if (!$statement->execute()) 
        {
            throw new Exception($statement->error);
        }
    }

    /**
     * Returns product id if already in basket.
     * @param product_id if of product.
     * @param user_id id of user.
     * @param color_id id of color.
     * @param size_id id of size.
     * @param order_id id of order.
     * @throws Exception if database connection fails.
     * @return int id of product or 0.
     */
    public function checkIfProductAllreadyInBasket($product_id, $user_id, $color_id, $size_id, $order_id)
    {
        $query = 
            "SELECT * FROM orders_products 
                WHERE ProductID = ? 
                AND ColorID = ? 
                AND SizeID = ? 
                AND OrderID = (SELECT ID FROM orders 
                    WHERE UserID = ? 
                    AND StageID = (SELECT ID FROM stages WHERE NAME LIKE 'Warenkorb' LIMIT 1) 
                    LIMIT 1) 
                AND OrderID = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('iiiii', $product_id, $color_id, $size_id, $user_id, $order_id);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) 
        {
            throw new Exception($statement->error);
        }
        if (mysqli_num_rows($result) == 0) 
        {
            return 0;
        }

        $row = $result->fetch_object();
        $result->close();
        return $row->ID;
    }

    /**
     * Update status of order.
     * @param user_id id of user.
     * @throws Exception if database connection fails.
     */
    public function payBasket($user_id)
    {
        //get the id of the order that represents the basket
        $basket_id = $this->getBasketID($user_id);
        //return if there is no basket
        if ($basket_id == 0) 
        {
            return;
        }
        if($this->checkIfBasketEmptyByBasket($basket_id))
        {
            return;
        }

        $query = "UPDATE orders SET StageID = (SELECT ID FROM stages where NAME like 'Gekauft' limit 1) where ID = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $basket_id);

        if (!$statement->execute()) 
        {
            throw new Exception($statement->error);
        }
    }

    /**
     * Check if basket exists.
     * @param basket_id id of basket.
     * @throws Exception if database connection fails.
     * @return boolean
     */
    public function checkIfBasketEmptyByBasket($basket_id)
    {
        $query = "SELECT * FROM orders_products where OrderID = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $basket_id);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) 
        {
            throw new Exception($statement->error);
        }
        return mysqli_num_rows($result) == 0;
    }

    /**
     * Checks if user has basket.
     * @param user_id id of user.
     * @return boolean
     */
    public function checkIfBasketEmptyByUser($user_id)
    {
        $basket_id = $this->getBasketID($user_id);
        //return if there is no basket
        if ($basket_id == 0) 
        {
            return true;
        }
        return $this->checkIfBasketEmptyByBasket($basket_id);
    }
}