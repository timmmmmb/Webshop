<?php

/**
 * ConnectionHandler provides a quick and easy access to database.
 */
class ConnectionHandler
{
    private static $connection = null;

    //Private constructor to prevent class instances.
    private function __construct() { }

    /**
     * Creates connection to database if it does not exist already.
     * @throws Exception if connection error occurs.
     * @return MySQLi MySQLi connection that can execute queres.
     */
    public static function getConnection()
    {
        if (self::$connection === null) 
        {
            $config = require 'config.php';
            $host = $config['database']['host'];
            $username = $config['database']['username'];
            $password = $config['database']['password'];
            $database = $config['database']['database'];

            //Initialize connection
            self::$connection = new MySQLi($host, $username, $password, $database);
            if (self::$connection->connect_error) 
            {
                $error = self::$connection->connect_error;
                throw new Exception("Connection error: $error");
            }

            self::$connection->set_charset('utf8');
        }

        //Return connection
        return self::$connection;
    }
}