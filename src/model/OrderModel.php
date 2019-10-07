<?php

require_once 'src/lib/Model.php';

class OrderModel extends Model
{
    /**
     * adds a new product to the basket of the user
     * @throws Exception
     */
    public function addToBasket($product_id, $user_id, $amount, $colorid, $sizeid){
        //get the id of the order that represents the basket
        $basket_id = $this->getBasketID($user_id);
        //create a new basket if there is none in the db
        if($basket_id == 0){
            $this->createBasket($user_id);
            $basket_id = $this->getBasketID($user_id);
        }

        //check if product is allready in basket
        $orderid = $this->checkIfProductAllreadyInBasket($product_id, $user_id, $colorid, $sizeid, $basket_id);
        if($orderid == 0){
            //add product to the basket
            $query="INSERT INTO orders_products (productid, orderid, amount, sizeid, colorid) VALUES (?, ?, ?, ?, ?)";

            $statement = ConnectionHandler::getConnection()->prepare($query);
            $statement->bind_param('iiiii', $product_id, $basket_id, $amount, $sizeid, $colorid);

            if (!$statement->execute()) {
                throw new Exception($statement->error);
            }
        }else{
            $this->addProductAmount($amount, $orderid);
        }

    }

    /**
     * gets the basket id of the user specified
     * @param $user_id the id of the user
     * @return int
     * @throws Exception
     */
    private function getBasketID($user_id){
        $query = "SELECT * FROM orders WHERE userid = ? and stageid = 1";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $user_id);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if (mysqli_num_rows($result)==0){
            return 0;
        }
        $row = $result->fetch_object();
        $result->close();
        return $row->ID;
    }

    /**
     * create a new order for the user where with the stage set to basket
     * @param $userid
     * @throws Exception
     */
    private function createBasket($userid){
        $query="INSERT INTO orders (userID, stageID) VALUES (?, 1)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $userid);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function getProductsInBasket($userid){
        $basketid = $this->getBasketID($userid);
        $query =
            "SELECT
                p.id as ID,
                p.name as name,
                p.preis as prize,
                CONVERT(p.preis*sum(amount),DECIMAL(65,2)) as total_prize,
                sum(amount) as amount,
                c.Name as color,
                s.name as size,
                op.ID as order_id
            FROM orders_products as op
                JOIN products p ON op.ProductID = p.ID
                JOIN colors c ON op.ColorID = c.ID
                JOIN sizes s ON op.SizeID = s.ID
            WHERE OrderID = ?
            group by NAME, color, size";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $basketid);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function removeItemByID($id){
        $query = "DELETE FROM orders_products where id = ? ";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function changeProductAmount($amount, $id){
        $query = "UPDATE orders_products SET amount=? where ID = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $amount,$id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function addProductAmount($amount, $id){
        $query = "UPDATE orders_products SET amount=amount+? where ID = ? ";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $amount,$id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function checkIfProductAllreadyInBasket($productid, $userid, $colorid, $sizeid, $orderid){
        $query = "SELECT * FROM orders_products where ProductID = ? and ColorID = ? and SizeID = ? and OrderID = (SELECT ID FROM orders where UserID = ? and StageID = 1 limit 1) and OrderID = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('iiiii', $productid,$colorid, $sizeid, $userid, $orderid);
        $statement->execute();


        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        if (mysqli_num_rows($result)==0){
            return 0;
        }
        $row = $result->fetch_object();
        $result->close();
        return $row->ID;
    }
}