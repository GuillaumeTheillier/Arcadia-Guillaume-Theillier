<?php

use DatabaseConnection\RelationnalDatabaseConnection;

class AnimalsRepository
{
    private RelationnalDatabaseConnection $connection;

    function __construct()
    {
        $this->connection = new RelationnalDatabaseConnection;
    }

    /**
     * Get all data animals from database.
     * 
     * @param string $habitat Animals from the selected habitat parameter.
     * @return array Array of all data animal from the same habitat.
     */
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

    /**
     * Get one data animal from database.
     * 
     * @param string $habitat Unique animal name.
     * @return array Array of one data animal.
     */
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

    /**
     * Create animal and transfer all data in database.
     * 
     * @param string $name Unique animal name.
     * @param string $image image data in base64.
     * @param int $habitat habitat id.
     * @param int $race race id.     * 
     * @return Bool TRUE on success or FALSE on failure.
     */
    function createAnimal(string $name, string $image, int $habitat, int $race): bool
    {
        $statement = $this->connection->getConnection()->prepare('INSERT INTO animals(name,image,habitat_id,race_id)
                                                                  VALUES (?, ?, ?, ?)
                                                                ');
        return $statement->execute([$name, $image, $habitat, $race]);
    }

    /**
     * Update one data animal from database.
     * 
     * @param string $name Unique animal name.
     * @return Bool TRUE on success or FALSE on failure.
     */
    function updateAnimal(int $id, string $name, string|null $image = NULL, string $status)
    {
        //var_dump([$id, $title, $description, $image, $descAdd]);

        if ($image !== '' || $image != null) {
            $statement = $this->connection->getConnection()->prepare('UPDATE `animals`
                                                                  SET name = ?, image = ?, status = ? 
                                                                  WHERE id = ?;
                                                                  ');

            $success = $statement->execute([$name, $image, $status, $id]);
        } else {
            $statement = $this->connection->getConnection()->prepare('UPDATE `animals`
                                                                  SET name = ?, status = ? 
                                                                  WHERE id = ?;
                                                                  ');

            $success = $statement->execute([$name, $status, $id]);
        }

        return $success;
    }

    /**
     * Update animal status in database.
     * 
     * @param string $name Unique animal name.
     * @param string $status New status to modify in databse.
     * @return Bool TRUE on success or FALSE on failure.
     */
    function updateStatus(string $name, string $status) {}

    /**
     * Add animal race in race table.
     * 
     * @param string $race Unique animal name.     * 
     * @return Bool TRUE on success or FALSE on failure.
     */
    function addRace(string $race): bool
    {
        $statement = $this->connection->getConnection()->prepare('INSERT INTO race(label) VALUES label=?');
        return $statement->execute([$race]);
    }

    /**
     * Delete all data for one animal in database.
     * 
     * @param string $id Unique animal id.
     * @return Bool TRUE on success or FALSE on failure.
     */
    function deleteAnimal(int $id): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM animals WHERE id=?');
        return $statement->execute([$id]);
    }
}
