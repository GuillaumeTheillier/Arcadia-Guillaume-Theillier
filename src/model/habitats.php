<?php

require_once('database.php');

class HabitatsRepository
{
    private DatabaseConnection $connection;

    function __construct()
    {
        $this->connection = new DatabaseConnection;
    }

    function getAllHabitats(): array
    {
        $statement = $this->connection->getConnection()
            ->prepare('SELECT habitats.nom as nom, images.data as image
                        FROM habitat_image
                        LEFT JOIN habitats ON habitat_image.habitat_id = habitats.id
                        LEFT JOIN images ON habitat_image.image_id = images.id
                    ');
        $statement->execute();
        while ($habitat = $statement->fetch(pdo::FETCH_ASSOC)) {
            //We encode the image in base64 to display with img balise
            $habitat['image'] = base64_encode($habitat['image']);
            $habitats[] = $habitat;
        }

        return $habitats;
    }

    function getHabitat(string $habitat): array
    {
        $statement = $this->connection->getConnection()
            ->prepare('SELECT habitats.nom as nom, images.data as image, habitats.description as description
                        FROM habitat_image
                        LEFT JOIN habitats ON habitat_image.habitat_id = habitats.id
                        LEFT JOIN images ON habitat_image.image_id = images.id
                        WHERE nom = ?
                    ');
        $statement->execute([$habitat]);

        $habitat = $statement->fetch(pdo::FETCH_ASSOC);
        //We encode the image in base64 to display with img balise
        $habitat['image'] = base64_encode($habitat['image']);

        return $habitat;
    }

    function editHabitat(int $id, string $name, string $description, string $image, string $comment): bool
    {
        if ($image === '') {
            $statement = $this->connection->getConnection()->prepare('UPDATE habitat_image 
                                                                      LEFT JOIN habitats ON habitat_image.habitat_id = habitats.id
                                                                      LEFT JOIN images ON habitat_image.image_id = images.id
                                                                      SET habitats.nom = ?, habitats.description = ?, images.data = ?,habitats.commentaire_habitat = ?                                                                  
                                                                      WHERE habitat_id = ?
                                                                    ');
            return $statement->execute([$name, $description, $comment, $id]);
        } else {
            $statement = $this->connection->getConnection()->prepare('UPDATE habitat_image 
                                                                      LEFT JOIN habitats ON habitat_image.habitat_id = habitats.id
                                                                      LEFT JOIN images ON habitat_image.image_id = images.id
                                                                      SET habitats.nom = ?, habitats.description = ?, images.data = ?,habitats.commentaire_habitat = ?                                                                  
                                                                      WHERE habitat_id = ?
                                                                    ');
            return $statement->execute([$name, $description, $comment, $id]);
        }
    }

    function newHabitat(string $name, string $description, string $image)
    {
        $statement = $this->connection->getConnection()->prepare('INSERT INTO habitats(nom, description) VALUES (?,?);
                                                                  INSERT INTO images(id, data) VALUES (?,?);
                                                                  INSERT INTO habitat_image(habitat_id, image_id) VALUES (?,?);
                                                                ');

        //We retrieve the habitat id to match him with the image id
        $idHabitatQuery = $this->connection->getConnection()->prepare('SELECT id FROM habitats WHERE nom=?');
        $idHabitatQuery->execute([$name]);
        $idHabitat = $idHabitatQuery->fetch(pdo::FETCH_ASSOC);

        //FORMAT id image : 31, first digit is for habitat id and the second for image
        //exemple : $idhabitat * 10 + 1 = 21
        $idImage = $idHabitat * 10 + 1;

        $statement->execute([$name, $description, $idImage, $image, $idHabitat['id'], $idImage]);
    }

    function deleteHabitat(int $id): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM habitat_image WHERE habitat_id = ?;
                                                                  DELETE FROM habitat WHERE id = ?;                                                                  
                                                                ');
        //Delete all images are starting by the id habitat digit 
        return $statement->execute([$id, $id * 10]);
    }
}
