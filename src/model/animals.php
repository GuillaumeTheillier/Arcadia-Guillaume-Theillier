<?php

require_once('database.php');

class AnimalsRepository
{
    private DatabaseConnection $connection;

    function __construct()
    {
        $this->connection = new DatabaseConnection;
    }

    function getAllAnimalsInHabitat(string $habitat): array
    {
        $statement = $this->connection->getConnection()->prepare('SELECT name, race.label as race, image 
                                                                  FROM animals 
                                                                  LEFT JOIN race ON animals.race_id = race.id
                                                                  LEFT JOIN habitats ON animals.habitat_id = habitats.id
                                                                  WHERE habitats.nom = ?  
                                                                ');
        $statement->execute([$habitat]);

        $animals = [];

        while ($animal = $statement->fetch(pdo::FETCH_ASSOC)) {
            $animal['image'] = base64_encode($animal['image']);

            $animals[] = $animal;
        }

        return $animals;
    }

    function getAnimal(string $animal): array
    {
        $statement = $this->connection->getConnection()->prepare('SELECT name, race.label as race, image, habitats.nom as habitat, status 
                                                                  FROM animals 
                                                                  LEFT JOIN race ON animals.race_id = race.id
                                                                  LEFT JOIN habitats ON animals.habitat_id = habitats.id
                                                                  WHERE name = ?
                                                                ');
        $statement->execute([$animal]);


        $animal = $statement->fetch(pdo::FETCH_ASSOC);
        $animal['image'] = base64_encode($animal['image']);

        return $animal;
    }

    function editAnimal()
    {
    }

    function newAnimal()
    {
    }

    function deleteAnimal()
    {
    }
}
