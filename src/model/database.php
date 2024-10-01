<?php

namespace DatabaseConnection;

use Exception;
use PDO;

class RelationnalDatabaseConnection
{
    public ?PDO $database = null;

    function getConnection(): PDO
    {
        if ($this->database === null) {
            try {
                $this->database = new PDO('mysql:host=localhost;dbname=arcadia;charset=utf8', 'root', '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        return $this->database;
    }
}

namespace UnrelationnalDatabaseConnection;

use Exception;
use PDO;

class UnrelationnalDatabaseConnection
{
    public ?PDO $database = null;

    function getConnection(): PDO
    {
        if ($this->database === null) {
            try {
                $this->database = new PDO('mongodb://localhost:27017/');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $this->database;
    }
}
