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
     * Diese Funktion erstellt einen neuen user.
     *
     * @param $name name des users
     * @param $email email des users
     * @param $password password des users
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function createUser($name,$email,$password)
    {
        $query="INSERT INTO users (Name, EMail, Password, User_TypeID) VALUES ('$name', '$password', '$email', '1')";

        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('s', $name);
        $statement->bind_param('s', $password);
        $statement->bind_param('s', $email);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

    }

}