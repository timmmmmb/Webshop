<?php

require_once 'src/lib/Model.php';

class UserModel extends Model
{
    protected $tableName = 'users';

    public function create()
    {

    }

    public function delete()
    {

    }

    /**
     * Store new user in database
     *
     * @param $name Username
     * @param $email user e-mail
     * @param $password User password
     * @param $typeid User classification
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function createUser($name, $email, $password, $typeid)
    {
        $query="INSERT INTO users (Name, EMail, Password, User_TypeID) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssi', $name, $email, $password, $typeid);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        echo "<script> window.location.href='/'; </script>";
    }

    public function getUserByNameAndPassword($name,$password){

    }

}