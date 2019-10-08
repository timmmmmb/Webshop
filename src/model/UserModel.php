<?php

require_once 'src/lib/Model.php';

/**
 * Database interface of the UserController class.
 */
class UserModel extends Model
{
    protected $tableName = 'users';

    /**
     * Store new user in database.
     *
     * @param $name Username
     * @param $email user e-mail
     * @param $password User password
     * @param $typeid User classification
     * @throws Exception Falls das Ausführen des Statements fehlschlägt
     */
    public function createUser($name, $email, $password, $typeid) 
    {
        $query="INSERT INTO users (Name, EMail, Password, User_TypeID) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssi', $name, $email, $password, $typeid);

        if (!$statement->execute()) 
        {
            throw new Exception($statement->error);
        }
    }

    /**
     * Checks if a user with this name and pw exists.
     * Returns the row if the user exists.
     * 
     * @param $name
     * @param $password
     * @return Object User properties.
     */
    public function getUserByNameAndPassword($name, $password) 
    {
        $query = "SELECT u.id as ID, u.name as Name, email, ut.Name as Type FROM users as u join user_types as ut on ut.ID = u.User_TypeID WHERE u.NAME like ? and u.PASSWORD like ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss', $name, $password);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) 
        {
            throw new Exception($statement->error);
        }

        $row = $result->fetch_object();
        $result->close();
        return $row;
    }

    /**
     * Checks if a user with these credentials allready exists.
     * Returns true if the user doesnt exist yet.
     * 
     * @param $email
     * @param $name
     * @return boolean
     */
    public function userExists($email, $name) 
    {
        $query = "SELECT * FROM $this->tableName WHERE NAME like ? or EMAIL like ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ss', $email, $name);
        $statement->execute();

        $result = $statement->get_result();
        if (!$result) 
        {
            throw new Exception($statement->error);
        }
        
        $exists = mysqli_num_rows($result) == 0;
        $result->close();
        return $exists;
    }

}