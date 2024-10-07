<?php

//use DatabaseConnection\UnrelationnalDatabaseConnection;

require 'vendor/autoload.php';

class ScheduleRepository
{
    //private UnrelationnalDatabaseConnection $connection;
    private $arcadiadb;

    public function __construct()
    {
        //$this->connection = new UnrelationnalDatabaseConnection;
        //$this->connection = $this->connection->schedule;
        $client = new MongoDB\Client();
        $this->arcadiadb = $client->arcadia;
    }

    function getSchedule()
    {
        //$get = $this->connection->schedule->findOne();
        $mycoll = $this->arcadiadb->schedule;

        $result = $mycoll->findOne();

        foreach ($result as $key => $res) {
            $schedule[$key] = $res;
        }
        return $schedule;
    }
}
