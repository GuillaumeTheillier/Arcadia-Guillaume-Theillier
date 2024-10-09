<?php

use DatabaseConnection\RelationalDatabaseConnection;
use DatabaseConnection\UnrelationalDatabaseConnection;

class AnimalsRepository
{
    private RelationalDatabaseConnection $relDbConnection;
    private UnrelationalDatabaseConnection $unrelDbConnection;

    function __construct()
    {
        $this->relDbConnection = new RelationalDatabaseConnection;
        $this->unrelDbConnection = new UnrelationalDatabaseConnection;
    }

    /**
     * Get all data animals from database in a specific habitat.
     * 
     *
     * @return array Array of all data animal from the same habitat.
     */
    function getAllAnimal(int $id = null, string $filterType = null): array
    {
        $animals = [];

        if ($filterType === null) {
            $statement = $this->relDbConnection->getConnection()->prepare('SELECT animals.id as id, name, race.label as race, habitats.nom as habitat, habitats.id as habitatId
                                                                  FROM animals 
                                                                  LEFT JOIN race ON animals.race_id = race.id
                                                                  LEFT JOIN habitats ON animals.habitat_id = habitats.id
                                                                  ORDER BY name ASC 
                                                                ');
            $statement->execute();
        } else if ($filterType === 'habitat') {
            $statement = $this->relDbConnection->getConnection()->prepare('SELECT animals.id as id, name, race.label as race, habitats.nom as habitat, habitats.id as habitatId
                                                                        FROM animals 
                                                                        LEFT JOIN race ON animals.race_id = race.id
                                                                        LEFT JOIN habitats ON animals.habitat_id = habitats.id
                                                                        WHERE habitats.id = ?
                                                                        ORDER BY name ASC 
                                                                        ');
            $statement->execute([$id]);
        } else if ($filterType === 'race') {
            $statement = $this->relDbConnection->getConnection()->prepare('SELECT animals.id as id, name, race.label as race, habitats.nom as habitat, habitats.id as habitatId
                                                                        FROM animals 
                                                                        LEFT JOIN race ON animals.race_id = race.id
                                                                        LEFT JOIN habitats ON animals.habitat_id = habitats.id
                                                                        WHERE race.id = ?
                                                                        ORDER BY name ASC 
                                                                        ');
            $statement->execute([$id]);
        }

        while ($animal = $statement->fetch(pdo::FETCH_ASSOC)) {
            $animals[] = $animal;
        }
        return $animals;
    }

    /**
     * Get all data animals from database in a specific habitat.
     * 
     * @param string $habitat Animals from the selected habitat parameter.
     * @return array Array of all data animal from the same habitat.
     */
    function getAllAnimalsInHabitat(int $habitat): array
    {
        $animals = [];

        $statement = $this->relDbConnection->getConnection()->prepare('SELECT animals.id as id, name, race.label as race, image 
                                                                  FROM animals 
                                                                  LEFT JOIN race ON animals.race_id = race.id
                                                                  LEFT JOIN habitats ON animals.habitat_id = habitats.id
                                                                  WHERE habitats.id = ?  
                                                                ');
        $statement->execute([$habitat]);

        while ($animal = $statement->fetch(pdo::FETCH_ASSOC)) {
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
    function getAnimal(int $animal): array
    {
        $statement = $this->relDbConnection->getConnection()->prepare('SELECT animals.id as id, name, race.label as race, image, habitats.nom as habitat, habitats.id as habitatId, status
                                                                  FROM animals 
                                                                  LEFT JOIN race ON animals.race_id = race.id
                                                                  LEFT JOIN habitats ON animals.habitat_id = habitats.id
                                                                  WHERE animals.id = ?
                                                                ');
        $statement->execute([$animal]);
        $animal = $statement->fetch(pdo::FETCH_ASSOC);
        return $animal;
    }

    /**
     * Create animal and transfer all data in database.
     * 
     * @param string $name Unique animal name.
     * @param string $image image data in base64.
     * @param int $habitat habitat id.
     * @param int $race race id.
     * @return Bool TRUE on success or FALSE on failure.
     */
    function createAnimal(string $name, string $image, int $habitat, int $race): bool
    {
        $statement = $this->relDbConnection->getConnection()->prepare('INSERT INTO animals(name,image,habitat_id,race_id)
                                                                  VALUES (?, ?, ?, ?)
                                                                ');
        $success = $statement->execute([$name, $image, $habitat, $race]);
        $result = $this->AddAnimalToCollection($name);
        return ($success && $result);
    }

    /**
     * Update one data animal from database.
     * 
     * @param int $id Animal's identifier. It's unique and cannot be modified.
     * @param string $name Unique animal name.
     * @param string|null $image data image.
     * @return Bool TRUE on success or FALSE on failure.
     */
    function updateAnimal(int $id, string $name, int $habitat, int $race, string|null $image = NULL)
    {
        //var_dump([$id, $title, $description, $image, $descAdd]);
        if ($image !== '' && $image != null) {
            $statement = $this->relDbConnection->getConnection()->prepare('UPDATE `animals`
                                                                  SET name = ?, image = ?, habitat_id = ?, race_id = ?
                                                                  WHERE id = ?;
                                                                  ');

            $success = $statement->execute([$name, $image, $habitat, $race, $id]);
        } else {
            $statement = $this->relDbConnection->getConnection()->prepare('UPDATE `animals`
                                                                  SET name = ?, habitat_id = ?, race_id = ?
                                                                  WHERE id = ?;
                                                                  ');

            $success = $statement->execute([$name, $habitat, $race, $id]);
        }

        return $success;
    }

    /**
     * Update animal status in database.
     * 
     * @param int $idAnimal Unique animal id.
     * @param string $status New status to modify in databse.
     * @return Bool TRUE on success or FALSE on failure.
     */
    function updateStatus(int $idAnimal, string $status) {}

    /**
     * Delete all data for one animal in database.
     * 
     * @param string $id Unique animal id.
     * @return Bool TRUE on success or FALSE on failure.
     */
    function deleteAnimal(int $id): bool
    {
        $statement = $this->relDbConnection->getConnection()->prepare('DELETE FROM animals WHERE id=?');
        $success = $statement->execute([$id]);
        $result = $this->deleteAnimalToCollection($id);
        return ($success && $result);
    }

    /**
     * Get all race name and id from database
     * 
     */
    function getRace(): array
    {
        $statement = $this->relDbConnection->getConnection()->prepare('SELECT id, label FROM race ORDER BY label ASC');
        $statement->execute();
        while ($race = $statement->fetch(pdo::FETCH_ASSOC)) {
            $races[] = $race;
        }
        return $races;
    }

    /**
     * Add animal race in race table.
     * 
     * @param string $race Unique animal name.     * 
     * @return Bool TRUE on success or FALSE on failure.
     */
    function createRace(string $race): bool
    {
        $statement = $this->relDbConnection->getConnection()->prepare('INSERT INTO race(label) VALUES label=?');
        return $statement->execute([$race]);
    }

    function getAnimalName()
    {
        $statement = $this->relDbConnection->getConnection()->prepare('SELECT id, name FROM animals');
        $statement->execute();
        while ($animal = $statement->fetch(pdo::FETCH_ASSOC)) {
            $animalList[$animal['id']] = $animal['name'];
        }
        return $animalList;
    }

    function getAnimalId(string $name)
    {
        $statement = $this->relDbConnection->getConnection()->prepare('SELECT id FROM animals WHERE animals.name = ?');
        $statement->execute([$name]);
        $animalId = $statement->fetch(pdo::FETCH_ASSOC);
        return $animalId['id'];
    }

    /**
     * 
     */
    function getAnimalCountVisit()
    {
        try {
            $animal = array();
            $animalList = $this->getAnimalName();
            $result = $this->unrelDbConnection->getAnimalConnection()->find(
                [],
                [
                    //'limit' => 5,
                    'projection' => [
                        '_id' => 0,
                        'animal_id' => 1,
                        'count_visit' => 1
                    ],
                ]
            );
            foreach ($result as $key => $res) {
                $id = $res['animal_id'];
                $res['name'] = $animalList[$id];
                $animal[$key] = $res;
            }
            return $animal;
        } catch (Error $e) {
            return false;
        }
    }

    /**
     * Add one animal in unrelational database.
     * 
     * @param string $name Animal name.
     * @return Bool TRUE on success or FALSE on failure.
     */
    function AddAnimalToCollection(string $name): bool
    {
        try {
            $id = $this->getAnimalId($name);
            $result = $this->unrelDbConnection->getAnimalConnection()->insertOne(
                [
                    'animal_id' => $id,
                    'count_visit' => 0
                ]
            );
            if ($result->getInsertedCount() == 1) {
                return true;
            } else return false;
        } catch (Error $e) {
            return false;
        }
    }

    /**
     * Increase visit count.
     * 
     * @param int $id Unique animal id.
     * @return Bool TRUE on success or FALSE on failure.
     */
    function updateAnimalCountVisit(int $id): bool
    {
        try {
            $count = $this->unrelDbConnection->getAnimalConnection()->findOne(
                [
                    'animal_id' => $id
                ],
                [
                    'projection' => [
                        '_id' => 0,
                        'animal_id' => 1,
                        'count_visit' => 1
                    ]
                ]
            );
            $result = $this->unrelDbConnection->getAnimalConnection()->updateOne(
                [
                    'animal_id' => $id
                ],
                [
                    '$set' => ['count_visit' => $count['count_visit'] + 1]
                ]
            );
            if ($result->getModifiedCount() == 1) {
                return true;
            } else return false;
        } catch (Error $e) {
            //return false;
            var_dump($e->getMessage());
        }
    }

    /**
     * Delete all data for one animal in unrelational database.
     * 
     * @param int $id Unique animal id.
     * @return Bool TRUE on success or FALSE on failure.
     */
    function deleteAnimalToCollection(int $id): bool
    {
        try {
            $result = $this->unrelDbConnection->getAnimalConnection()->deleteOne(
                [
                    'animal_id' => $id
                ]
            );
            if ($result->getDeletedCount() == 1) {
                return true;
            } else return false;
        } catch (Error $e) {
            return false;
        }
    }
}
