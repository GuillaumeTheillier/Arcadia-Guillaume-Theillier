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
        $statement = $this->connection->getConnection()->prepare('SELECT nom, image 
                                                                    FROM habitats 
                                                                    LEFT JOIN image ON habitats.image_id = image.image_id
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
        $statement = $this->connection->getConnection()->prepare('SELECT nom, description, image 
                                                                    FROM habitats
                                                                    LEFT JOIN image ON habitats.image_id = image.image_id
                                                                    WHERE nom = ?');
        $statement->execute([$habitat]);

        $habitat = $statement->fetch(pdo::FETCH_ASSOC);
        //We encode the image in base64 to display with img balise
        $habitat['image'] = base64_encode($habitat['image']);

        return $habitat;
    }
}
