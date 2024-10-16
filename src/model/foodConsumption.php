<?php

use DatabaseConnection\RelationalDatabaseConnection;

class FoodConsumptionRepository
{
    private RelationalDatabaseConnection $connection;

    function __construct()
    {
        //At a new instance initialize connection with the DatabaseConnection class
        $this->connection = new RelationalDatabaseConnection;
    }

    /**
     * Adds a food consumption to the database.
     * 
     * @param Datetime $date Date and time of feeding.
     * @param String $food Type of food given to the animal.
     * @param String $quantity Quantity and unit of measure given.  
     * @return Bool TRUE on success or FALSE on failure.
     */
    function addConsumption(string $date, string $food, string $quantity, string $username, int $animalId)
    {
        $statement = $this->connection->getConnection()->prepare('INSERT INTO food_consumption(date, food_type, quantity, user_username, animal_id) 
                                                                                                VALUES (?, ?, ?, ?, ?);');
        return $statement->execute([$date, $food, $quantity, $username, $animalId]);
    }

    function getConsumption(int $animalId)
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
