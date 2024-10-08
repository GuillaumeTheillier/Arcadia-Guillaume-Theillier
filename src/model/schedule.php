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
        try {
            $mycoll = $this->arcadiadb->schedule;

            $result = $mycoll->findOne(['_id' => 'schedule']);

            foreach ($result as $key => $res) {
                $schedule[$key] = $res;
            }
            return $schedule;
        } catch (Error $e) {
            return false;
        }
    }

    function updateSchedule(array $schedule)
    {
        try {
            $mycoll = $this->arcadiadb->schedule;

            $result = $mycoll->updateOne(
                ['_id' => 'schedule'],
                [
                    '$set' => [
                        'monday' => [
                            'ouverture' => $schedule['mondayOpening'],
                            'fermeture' => $schedule['mondayClosing']
                        ],
                        'tuesday' => [
                            'ouverture' => $schedule['tuesdayOpening'],
                            'fermeture' => $schedule['tuesdayClosing']
                        ],
                        'wednesday' => [
                            'ouverture' => $schedule['wednesdayOpening'],
                            'fermeture' => $schedule['wednesdayClosing']
                        ],
                        'thursday' => [
                            'ouverture' => $schedule['thursdayOpening'],
                            'fermeture' => $schedule['thursdayClosing']
                        ],
                        'friday' => [
                            'ouverture' => $schedule['fridayOpening'],
                            'fermeture' => $schedule['fridayClosing']
                        ],
                        'saturday' => [
                            'ouverture' => $schedule['saturdayOpening'],
                            'fermeture' => $schedule['saturdayClosing']
                        ],
                        'sunday' => [
                            'ouverture' => $schedule['sundayOpening'],
                            'fermeture' => $schedule['sundayClosing']
                        ]
                    ]
                ]
            );
            return true;
        } catch (Error $e) {
            return $e->getMessage();
        }
    }
}
