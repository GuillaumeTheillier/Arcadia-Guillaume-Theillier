<?php

use DatabaseConnection\RelationnalDatabaseConnection;

class FoodConsumptionRepository
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
}
