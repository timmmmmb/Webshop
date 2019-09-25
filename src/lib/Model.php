<?php

require_once 'ConnectionHandler.php';

class Model
{
    protected $tableName = null;

    /**
     * Returns database entry by specific id.
     *
     * @param $id id of entry to retrieve.
     * @throws Exception if database connection fails.
     * @return Object entry of null if not exists.
     */
    public function readById($id)
    {
        $query = "SELECT * FROM $this->tableName WHERE id=?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $row = $result->fetch_object();
        $result->close();

        return $row;
    }

    /**
     * Returns all database entries from specific table.
     *
     * @throws Exception if database connection fails.
     * @return Array with database entries as objects.
     */
    public function readAll()
    {
        $query = "SELECT * FROM $this->tableName";

        $statement = ConnectionHandler::getConnection()->prepare($query);
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

    /**
     * Deletes entry with specific id.
     *
     * @param $id id of entry.
     * @throws Exception if database connection fails.
     */
    public function deleteById($id)
    {
        $query = "DELETE FROM $this->tableName WHERE id=?";
        
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}
