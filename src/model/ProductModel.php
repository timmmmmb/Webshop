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
}