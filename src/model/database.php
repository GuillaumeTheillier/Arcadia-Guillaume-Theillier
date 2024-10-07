<?php
//SQL database connection
namespace DatabaseConnection;

use Exception;
use PDO;
use MongoDB;

require 'vendor/autoload.php';

/**
 * Connection to SQL database.
 */
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

/**
 * Connection to MongoDb database.
 */
class UnrelationnalDatabaseConnection
{
    private $client = null;
    public $database = null;

    function getConnection()
    {
        if ($this->client === null) {
            try {
                $client = new MongoDB\Client();
                $database = $client->arcadia;
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $this->database;
    }
}
