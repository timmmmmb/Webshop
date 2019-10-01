<?php

require_once 'src/lib/Model.php';

class OrderModel extends Model
{
    /**
     * adds a new product to the baskett of the user
     */
    public function addToBasket($product_id, $user_id, $quantity, $color_id, $size_id){
        //get the id of the order that represents the basket
        $basket_id = $this->getBasketID($user_id);
        //create a new basket if there is none in the db
        if($basket_id == 0){
            $this->createBasket($user_id);
            $basket_id = $this->getBasketID($user_id);
        }
        //add product to the basket

    }

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
        return $row->id;
    }

    private function createBasket($user_id){
        $query="INSERT INTO orders (userID, stageID) VALUES (?, 1)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $user_id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}