<?php

class ConnectionHandler
{
    private static $connection = null;

    private function __construct()
    {
        //Privater Konstruktor um das erstellen von Instanzen zu verhindern
    }

    /**
     * Prüft ob bereits eine Verbindung auf die Datenbank existiert,
     * initialisiert diese ansonsten und gibt sie dann zurück.
     *
     * @throws Exception wenn der Verbindungsaufbau schiefgegeangen ist.
     * @return Die MySQLi Verbindung, welche für den Zugriff aud die Datenbank verwendet werden kann.
     */
    public static function getConnection()
    {
        if (self::$connection === null) {

            // Konfigurationsdatei auslesen
            $config = require 'config.php';
            $host = $config['database']['host'];
            $username = $config['database']['username'];
            $password = $config['database']['password'];
            $database = $config['database']['database'];

            // Verbindung initialisieren
            self::$connection = new MySQLi($host, $username, $password, $database);
            if (self::$connection->connect_error) {
                $error = self::$connection->connect_error;
                throw new Exception("Verbindungsfehler: $error");
            }

            self::$connection->set_charset('utf8');
        }

        // Verbindung zurückgeben
        return self::$connection;
    }
}
