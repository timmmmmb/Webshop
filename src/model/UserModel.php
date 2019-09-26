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

    /**
     * checks if a user with this name and pw exists
     * returns the row if the user exists
     * @param $name
     * @param $password
     */
    public function getUserByNameAndPassword($name,$password){
        $query = "SELECT * FROM $this->tableName WHERE NAME like ? and PASSWORD like ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss', $name,$password);
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
     * checks if a user with these credentials allready exists
     * returns true if the user doesnt exist yet
     * @param $email
     * @param $name
     */
    public function checkIfUserExists($email, $name){
        $query = "SELECT * FROM $this->tableName WHERE NAME like ? or EMAIL like ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss', $email,$name);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }
        $exists = mysqli_num_rows($result)==0;
        $result->close();

        return $exists;
    }

}