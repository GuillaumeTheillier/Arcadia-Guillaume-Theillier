<?php

namespace DatabaseConnection;

use Dotenv\Dotenv;
use Exception;
use PDO;
use MongoDB;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Connection to SQL database.
 */
class RelationalDatabaseConnection
{
    public ?PDO $database = null;
    private $url = null;

    function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        $this->url = $_ENV['DATABASE_MYSQL_URL'];
    }

    function getConnection(): PDO
    {
        if ($this->database === null) {
            $fields = parse_url($this->url);
            try {
                $this->database = new PDO('mysql:host=' . $fields["host"] . ';port=' . $fields["port"] . ';dbname=arcadia;sslmode=verify-ca;sslrootcert=ca.pem', $fields["user"], $fields["pass"]);
                //$this->database = new PDO('mysql:host=localhost;dbname=arcadia;charset=utf8', 'root', '');
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
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

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        $url = $_ENV['DATABASE_MONGODB_URL'];
        $this->client = new MongoDB\Client($url);
    }

    function getScheduleConnection()
    {
        if ($this->scheduleCollection === null) {
            try {
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
                $this->animalCollection = $this->client->arcadia->animal_count_visit;
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $this->animalCollection;
    }
}
