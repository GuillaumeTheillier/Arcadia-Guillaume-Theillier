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
}
