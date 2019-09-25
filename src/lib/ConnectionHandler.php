<?php

class ConnectionHandler
{
    private static $connection = null;

    private function __construct()
    {
        //Private constructor to prevent class instances.
    }

    /**
     * Creates connection to database if it does not exist already.
     *
     * @throws Exception if connection error occurs.
     * @return MySQLi MySQLi connection that can execute queres.
     */
    public static function getConnection()
    {
        if (self::$connection === null) {

            //Read login data from config.php
            $config = require 'config.php';
            $host = $config['database']['host'];
            $username = $config['database']['username'];
            $password = $config['database']['password'];
            $database = $config['database']['database'];

            //Initialize connection
            self::$connection = new MySQLi($host, $username, $password, $database);
            if (self::$connection->connect_error) {
                $error = self::$connection->connect_error;
                throw new Exception("Verbindungsfehler: $error");
            }

            self::$connection->set_charset('utf8');
        }

        //Return connection
        return self::$connection;
    }
}
