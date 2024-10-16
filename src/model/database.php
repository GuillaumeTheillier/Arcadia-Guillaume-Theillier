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
class RelationalDatabaseConnection
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
class UnrelationalDatabaseConnection
{
    private $client;
    public $scheduleCollection = null;
    public $animalCollection = null;

    function getScheduleConnection()
    {
        if ($this->scheduleCollection === null) {
            try {
                $this->client = new MongoDB\Client();
                $this->scheduleCollection = $this->client->arcadia->schedule;
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $this->scheduleCollection;
    }

    function getAnimalConnection()
    {
        if ($this->animalCollection === null) {
            try {
                $this->client = new MongoDB\Client();
                $this->animalCollection = $this->client->arcadia->animal_count_visit;
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $this->animalCollection;
    }
}
