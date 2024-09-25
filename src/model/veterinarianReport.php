<?php

use DatabaseConnection\RelationnalDatabaseConnection;

class VeterinarianReportRepository
{
    private RelationnalDatabaseConnection $connection;

    function __construct()
    {
        //At a new instance initialize connection with the DatabaseConnection class
        $this->connection = new RelationnalDatabaseConnection;
    }

    /**
     * Adds a food consumption to the database.
     * 
     * @param String $date Date and time of feeding.
     * @param String $food Type of food given to the animal.
     * @param String $quantity Quantity and unit of measure given.  
     * @return Bool TRUE on success or FALSE on failure.
     */
    function addReport(string $date, string $status, string $food, string $quantity, string $username, int $animalId, string $statusDetail = null)
    {
        if ($statusDetail === null) {
            $statement = $this->connection->getConnection()->prepare('INSERT INTO veterinarian_report(date, food_type, quantity, veterinarian_username, animal_id) 
                                                                                                VALUES (:date, :food, :quantity, :username, :animalId);
                                                                      UPDATE animals SET status = :status
                                                                      WHERE id = :animalId;');
        } else {
            $statement = $this->connection->getConnection()->prepare('INSERT INTO veterinarian_report(date, food_type, quantity, status_detail, veterinarian_username, animal_id) 
                                                                                                VALUES (:date, :food, :quantity, :statusDetail, :username,:animalId);
                                                                      UPDATE animals SET status = :status
                                                                      WHERE id = :animalId;');
            $statement->bindParam(':statusDetail', $statusDetail, PDO::PARAM_STR);
        }
        $statement->bindParam(':date', $date, PDO::PARAM_STR);
        $statement->bindParam(':food', $food, PDO::PARAM_STR);
        $statement->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':status', $status, PDO::PARAM_STR);
        $statement->bindParam(':animalId', $animalId, PDO::PARAM_INT);
        return $statement->execute();
    }

    /**
     *  Get report associates at one animals.
     * 
     * @param int $animalId animal's id 
     * @return array All report of the animal are given in param.
     */
    function getReport(int $animalId): array
    {
        $reportList = array();
        $statement = $this->connection->getConnection()->prepare('SELECT date, food_type as foodType, quantity
                                                                FROM food_consumption
                                                                WHERE animal_id = ?
                                                                ORDER BY date DESC');
        $statement->execute([$animalId]);
        while ($report = $statement->fetch(pdo::FETCH_ASSOC)) {
            $date = new DateTime($report['date']);
            $report['date'] = date_format($date, "d/m/Y H:i:s");
            $reportList[] = $report;
        }
        return $reportList;
    }

    /**
     *  Get all veterinarian reports.
     * 
     * @return array All animal's reports.
     */
    function getAllReport(string $sort = null, int|null $animalId = null, string|null $date = null)
    {
        $reportList = array();

        if ($sort === null || $sort === 'dateAsc') {
            $statement = $this->connection->getConnection()->prepare('SELECT date, food_type as foodType, quantity, status_detail as statusDetail, animals.name as animalName
                                                                  FROM veterinarian_report
                                                                  LEFT JOIN animals ON veterinarian_report.animal_id = animals.id
                                                                  ORDER BY date ASC');
        } elseif ($sort === 'dateDesc') {
            $statement = $this->connection->getConnection()->prepare('SELECT date, food_type as foodType, quantity, status_detail as statusDetail, animals.name as animalName
                                                                  FROM veterinarian_report
                                                                  LEFT JOIN animals ON veterinarian_report.animal_id = animals.id
                                                                  ORDER BY date DESC');
        } elseif ($sort === 'animalNameAsc') {
            $statement = $this->connection->getConnection()->prepare('SELECT date, food_type as foodType, quantity, status_detail as statusDetail, animals.name as animalName
                                                                  FROM veterinarian_report
                                                                  LEFT JOIN animals ON veterinarian_report.animal_id = animals.id
                                                                  ORDER BY animalName ASC');
        } elseif ($sort === 'animalNameDesc') {
            $statement = $this->connection->getConnection()->prepare('SELECT date, food_type as foodType, quantity, status_detail as statusDetail, animals.name as animalName
                                                                  FROM veterinarian_report
                                                                  LEFT JOIN animals ON veterinarian_report.animal_id = animals.id
                                                                  ORDER BY animalName DESC');
        }

        /*$statement = $this->connection->getConnection()->prepare('SELECT date, food_type as foodType, quantity, status_detail as statusDetail, animals.name as animalName
                                                                  FROM veterinarian_report
                                                                  LEFT JOIN animals ON veterinarian_report.animal_id = animals.id
                                                                  ORDER BY :sort');*/


        //var_dump($sort);
        //$statement->bindParam(':sort', $sort);
        $statement->execute();
        while ($report = $statement->fetch(pdo::FETCH_ASSOC)) {
            $reportDate = new DateTime($report['date']);
            $report['date'] = date_format($reportDate, "d/m/Y");
            $reportList[] = $report;
        }
        return $reportList;
    }
}
/*
function filterReport($date, $animalId, $statement)
{
    if ($date === null && $animalId === null) {
        $statement;
    }
}*/
/*
//par defaut
$statement = $this->connection->getConnection()->prepare('SELECT date, food_type as foodType, quantity, status_detail as statusDetail, animals.name as animalName
                                                                  FROM veterinarian_report
                                                                  LEFT JOIN animals ON veterinarian_report.animal_id = animals.id
                                                                  ORDER BY :sort');

//un filtre actif
$statement = $this->connection->getConnection()->prepare('SELECT date, food_type as foodType, quantity, status_detail as statusDetail, animals.name as animalName
                                                                  FROM veterinarian_report
                                                                  LEFT JOIN animals ON veterinarian_report.animal_id = animals.id
                                                                  ORDER BY :sort
                                                                  WHERE date = :date');

//deux filtre actif
$statement = $this->connection->getConnection()->prepare('SELECT date, food_type as foodType, quantity, status_detail as statusDetail, animals.name as animalName
                                                                  FROM veterinarian_report
                                                                  LEFT JOIN animals ON veterinarian_report.animal_id = animals.id
                                                                  ORDER BY :sort
                                                                  WHERE :date = :date AND animals.id = :animal');
*/