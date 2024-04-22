<?php

require_once('database.php');

class Service
{
    public string $nom;
    public string $description;
    public string $image;
    public string $descAdditional;
}

class ServicesRepository
{

    private DatabaseConnection $connection;

    function __construct()
    {
        $this->connection = new DatabaseConnection;
    }

    function getServices(): array
    {
        $statement = $this->connection->getConnection()->prepare('SELECT id, title, description, image, description_additional FROM services');
        $statement->execute();


        while ($service = $statement->fetch(pdo::FETCH_ASSOC)) {
            //We encode the image in base64 to display with img balise
            $service['image'] = base64_encode($service['image']);
            $services[] = $service;
        }

        return $services;
    }

    function deleteService(int $idService): bool
    {
        $statement = $this->connection->getConnection()->prepare('DELETE FROM `services` WHERE id = ?');

        return $statement->execute([$idService]);
    }

    function editService(int $id, string $title, string $description, string $image, string $descAdd): bool
    {
        $statement = $this->connection->getConnection()->prepare('UPDATE \'services\' 
                                                                  SET title = ?, description = ?, image = ?, description_additional = ? 
                                                                  WHERE id = ?
                                                                  ');

        $success = $statement->execute([$title, $description, $image, $descAdd, $id]);

        return $success;
    }

    function newService(string $title, string $description, string $image, string $descAdd): bool
    {
        $statement = $this->connection->getConnection()->prepare("INSERT INTO 'services'('title','description','image','description_additional')
                                                                  VALUES (?, ?, ?, ?)
                                                                ");

        $success = $statement->execute([$title, $description, $image, $descAdd]);

        return $success;
    }
}
