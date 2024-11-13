<?php
//SQL database connection
namespace DatabaseConnection;

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
    private $host = 'arcadiamysqlserver.mysql.database.azure.com';
    private $username = 'guillaumeTheillier';
    private $password = 'eZm37AyZ6!_/5q';
    private $db_name = 'arcadiadb';
    private $options = array(
        PDO::MYSQL_ATTR_SSL_CA => 'DigiCertGlobalRootG2.crt.pem',
        //PDO::MYSQL_ATTR_SSL_CERT => 'DigiCertGlobalRootG2.crt.pem',
        //PDO::MYSQL_ATTR_SSL_KEY => ,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
        //pdo::mysql_attr_publ
    );

    function getConnection(): PDO
    {
        if ($this->database === null) {
            try {
                //$this->database = new PDO("mysql:host=$this->host;port=3306;dbname=$this->db_name;charset=utf8", $this->username, $this->password, $this->options);
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

    public function __construct()
    {
        $url = 'mongodb+srv://GuillaumeThlr:hFXIt9gQ4VUD86wt@guillaumetheillier.oj999.mongodb.net/?retryWrites=true&w=majority&appName=GuillaumeTheillier';
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
