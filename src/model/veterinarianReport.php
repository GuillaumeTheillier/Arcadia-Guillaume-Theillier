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

            $statement->bindParam(':date', $date, PDO::PARAM_STR);
            $statement->bindParam(':food', $food, PDO::PARAM_STR);
            $statement->bindParam(':quantity', $quantity, PDO::PARAM_STR);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':status', $status, PDO::PARAM_STR);
            $statement->bindParam(':animalId', $animalId, PDO::PARAM_INT);
            return $statement->execute();
        } else {
            $statement = $this->connection->getConnection()->prepare('INSERT INTO veterinarian_report(date, food_type, quantity, status_detail, veterinarian_username, animal_id) 
                                                                                                VALUES (:date, :food, :quantity, :statusDetail, :username,:animalId);
                                                                      UPDATE animals SET status = :status
                                                                      WHERE id = :animalId;');

            $statement->bindParam(':date', $date, PDO::PARAM_STR);
            $statement->bindParam(':food', $food, PDO::PARAM_STR);
            $statement->bindParam(':quantity', $quantity, PDO::PARAM_STR);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':statusDetail', $statusDetail, PDO::PARAM_STR);
            $statement->bindParam(':status', $status, PDO::PARAM_STR);
            $statement->bindParam(':animalId', $animalId, PDO::PARAM_INT);
            return $statement->execute();
        }
    }

    function getReport(int $animalId)
    {
        $consumptionList = [];
        $statement = $this->connection->getConnection()->prepare('SELECT date, food_type as foodType, quantity
                                                                FROM food_consumption
                                                                WHERE animal_id = ?
                                                                ORDER BY date DESC');
        $statement->execute([$animalId]);
        while ($consumption = $statement->fetch(pdo::FETCH_ASSOC)) {
            $date = new DateTime($consumption['date']);
            $consumption['date'] = date_format($date, "d/m/Y H:i:s");

            $consumptionList[] = $consumption;
        }
        return $consumptionList;
    }
}
