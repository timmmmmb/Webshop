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
     * @param string $name Username
     * @param string $email user e-mail
     * @param string $password User password
     * @param int $typeid User classification
     * @throws Exception if database connection fails.
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
     * Retrieves all users from database.
     * @throws Exception if database connection fails.
     * @return Array of user objects.
     */
    public function getAllUsers()
    {
        $query = 
            "SELECT 
                u.id as ID, 
                u.name as Name, 
                email, 
                ut.Name_de as Type_de,
                ut.Name_en as Type_en 
            FROM users as u 
            JOIN user_types as ut ON ut.ID = u.User_TypeID";

        $statement = ConnectionHandler::getConnection()->prepare($query);
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
     * Checks if a user with this name and pw exists.
     * Returns the row if the user exists.
     * @param string $name Username.
     * @param string $password Password.
     * @throws Exception if database connection fails.
     * @return Object User properties.
     */
    public function getUserByNameAndPassword($name, $password) 
    {
        $query = 
            "SELECT 
                u.id as ID, 
                u.name as Name, 
                email, 
                ut.Name_de as Type_de,
                ut.Name_EN  as Type_en
            FROM users as u 
            JOIN user_types as ut ON ut.ID = u.User_TypeID 
            WHERE u.NAME LIKE ? AND u.PASSWORD LIKE ?";

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
     * @param string $email input email.
     * @param string $name input name.
     * @throws Exception if database connection fails.
     * @return boolean
     */
    public function userDoesNotExists($email, $name) 
    {
        $query = "SELECT * FROM users WHERE NAME LIKE ? OR EMAIL LIKE ?";

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

    /**
     * Updates Email
     * @param string $email new email.
     * @param int $id specifies which user to update.
     * @throws Exception if statement could not execute.
     */
    public function updateUserEmail($email, $id) 
    {
        $query="UPDATE users SET EMail = ? WHERE id = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $email, $id);

        if (!$statement->execute()) 
        {
            throw new Exception($statement->error);
        }
    }

}