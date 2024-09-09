<?php

use DatabaseConnection\RelationnalDatabaseConnection;

require_once('database.php');

class HabitatsRepository
{
    private RelationnalDatabaseConnection $connection;

    function __construct()
    {
        $this->connection = new RelationnalDatabaseConnection;
    }

    function getAllHabitats(): array
    {
        $statement = $this->connection->getConnection()
            ->prepare('SELECT habitats.nom as nom, images.data as image, habitats.id as id
                        FROM habitat_image
                        LEFT JOIN habitats ON habitat_image.habitat_id = habitats.id
                        LEFT JOIN images ON habitat_image.image_id = images.id
                    ');
        $statement->execute();
        while ($habitat = $statement->fetch(pdo::FETCH_ASSOC)) {
            $habitats[] = $habitat;
        }
        return $habitats;
    }

    function getHabitat(int $habitat): array
    {
        $statement = $this->connection->getConnection()
            ->prepare('SELECT habitats.nom as nom, images.data as image, habitats.description as description, habitats.id as id
                        FROM habitat_image
                        LEFT JOIN habitats ON habitat_image.habitat_id = habitats.id
                        LEFT JOIN images ON habitat_image.image_id = images.id
                        WHERE habitats.id = ?
                    ');
        $statement->execute([$habitat]);
        $habitat = $statement->fetch(pdo::FETCH_ASSOC);
        return $habitat;
    }

    function getHabitatList(): array
    {
        $statement = $this->connection->getConnection()->prepare('SELECT id, nom FROM habitats');
        $statement->execute();
        while ($habitat = $statement->fetch(pdo::FETCH_ASSOC)) {
            $habitats[] = $habitat;
        }
        return $habitats;
    }

    function updateHabitat(int $id, string $name, string $description, string|null $image = NULL): bool
    {
        if ($image == NULL && $image == '') {
            $statement = $this->connection->getConnection()->prepare('UPDATE habitat_image 
                                                                      LEFT JOIN habitats ON habitat_image.habitat_id = habitats.id
                                                                      LEFT JOIN images ON habitat_image.image_id = images.id
                                                                      SET habitats.nom = ?, habitats.description = ?                                                                
                                                                      WHERE habitat_id = ?
                                                                    ');
            return $statement->execute([$name, $description, $id]);
        } else {
            $statement = $this->connection->getConnection()->prepare('UPDATE habitat_image 
                                                                      LEFT JOIN habitats ON habitat_image.habitat_id = habitats.id
                                                                      LEFT JOIN images ON habitat_image.image_id = images.id
                                                                      SET habitats.nom = ?, habitats.description = ?, images.data = ?                                                                  
                                                                      WHERE habitat_id = ?
                                                                    ');
            return $statement->execute([$name, $description, $image, $id]);
        }
    }

    function createHabitat(string $name, string $description, string $image): bool
    {
        //Insert new habitat before insert image and the connection between them
        $statement = $this->connection->getConnection()->prepare('INSERT INTO habitats(nom, description) VALUES (?,?);');
        $statement->execute([$name, $description]);
        //We retrieve the habitat id to match him with the image id
        $idHabitatQuery = $this->connection->getConnection()->prepare('SELECT id FROM habitats WHERE nom=?;');
        $idHabitatQuery->execute([$name]);
        $idHabitat = $idHabitatQuery->fetch(pdo::FETCH_ASSOC);
        //var_dump($idHabitat['id']);
        //FORMAT id image : 31, first digit is for habitat id and the second for image
        //example : $idhabitat * 10 + 1 = 21
        $idImage = $idHabitat['id'] * 10 + 1;
        //var_dump($idImage);
        //Insert image and connection between habitat and image database
        $statement = $this->connection->getConnection()->prepare('INSERT INTO images(id, data) VALUES (?,?);
                                                                  INSERT INTO habitat_image(habitat_id, image_id) VALUES (?,?);
                                                                ');
        return $statement->execute([$idImage, $image, $idHabitat['id'], $idImage]);
    }

    function deleteHabitat(int $idHabitat): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM habitat_image WHERE habitat_id = ?;
                                                                  DELETE FROM habitats WHERE id = ?;     
                                                                  DELETE FROM images WHERE id = ?;                                                             
                                                                ');
        //Delete all images are starting by the id habitat digit 
        return $statement->execute([$idHabitat, $idHabitat, $idHabitat * 10 + 1]);
    }
}
