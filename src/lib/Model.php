<?php

require_once 'ConnectionHandler.php';

class Model
{
    protected $tableName = null;

    /**
     * Diese Funktion gibt den Datensatz mit der gegebenen id zurück.
     *
     * @param $id id des gesuchten Datensatzes
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     * @return Der gesuchte Datensatz oder null, sollte dieser nicht existieren.
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
     * Diese Funktion gibt ein array mit allen Datensätzen aus der Tabelle
     * zurück.
     *
     * @param $max Wie viele Datensätze höchstens zurückgegeben werden sollen
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     * @return Ein array mit den gefundenen Datensätzen.
     */
    public function readAll()
    {
        $query = "SELECT p.*, u.* FROM $this->tableName AS p JOIN users AS u ON u.id_user = p.user_id ORDER BY date DESC";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Datensätze aus dem Resultat holen und in das Array $rows speichern
        $rows = array();
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * Diese Funktion löscht den Datensatz mit der gegebenen id.
     *
     * @param $id id des zu löschenden Datensatzes
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function deleteById($id)
    {
        
        $query = "DELETE FROM $this->tableName WHERE id=?";
        
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);
        
        $statement->execute();

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        
    }
}
