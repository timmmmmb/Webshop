<?php

require_once 'src/lib/Model.php';

/**
 * Retrieves all product related data from database.
 */
class ProductModel extends Model
{
    protected $tableName = 'products';

    /**
     * Gets available colors of product.
     * @param int $id id of product.
     * @throws Exception if database connection fails.
     * @return Array of objects.
     */
    public function readColorsByID($id) 
    {
        $query = "SELECT * FROM available_colors as ac JOIN colors as c ON c.id = ac.colorid WHERE productid = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);
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
     * Gets available sizes of product.
     * @param int $id id of product.
     * @throws Exception if database connection fails.
     * @return Array of objects.
     */
    public function readSizesByID($id) 
    {
        $query = "SELECT * FROM available_sizes as avs JOIN sizes as s ON s.id = avs.sizeid WHERE productid = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);
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
     * Gets products by gender.
     * @param string $sex
     * @throws Exception if db statement fails.
     * @return Array of Products.
     */
    public function getProductsBySex($sex) 
    {
        $query = "SELECT * FROM $this->tableName WHERE Sex = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $sex);
        $statement->execute();

        $result = $statement->get_result();
        if(!$result)
        {
            throw new Exception($statement->error);
        }

        $rows = array();
        while($row = $result->fetch_object())
        {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * @param string $keyword search query.
     * @throws Exception if db query fails.
     * @return Array list of products
     */
    public function searchProducts($keyword)
    {
        $keyword = '%'.$keyword.'%';
        $query = "SELECT * FROM $this->tableName 
            WHERE Name_DE LIKE ?
            OR Name_EN LIKE ? 
            OR Description_DE LIKE ?
            OR Description_EN LIKE ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssss', $keyword, $keyword, $keyword, $keyword);
        $statement->execute();

        $result = $statement->get_result();
        if(!$result)
        {
            throw new Exception($statement->error);
        }

        $rows = array();
        while($row = $result->fetch_object())
        {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * @param string $name_de
     * @param string $name_en
     * @param string $desc_de
     * @param string $desc_en
     * @param string $sex
     * @param string $image
     * @param string $price
     * @throws Exception if db statement fails.
     */
    public function insertProduct($name_de, $name_en, $desc_de, $desc_en, $sex, $image, $price)
    {
        $query="INSERT INTO $this->tableName (Name_DE, Name_EN, Description_DE, Description_EN, Sex, Image, Price) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssssssd', $name_de, $name_en, $desc_de, $desc_en, $sex, $image, $price);
        
        if (!$statement->execute()) 
        {
            throw new Exception($statement->error);
        }
        $this->insertSize(ConnectionHandler::getConnection()->insert_id, 1);
    }

    /**
     * Product must have some size.
     * @param int $productID
     * @param int $sizeID
     * @throws Exception if db statement fails.
     */
    private function insertSize($productID, $sizeID)
    {
        $query="INSERT INTO available_sizes (ProductID, SizeID) VALUES (?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ii', $productID, $sizeID);

        if (!$statement->execute()) 
        {
            throw new Exception($statement->error);
        }
    }
}