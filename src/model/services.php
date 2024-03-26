<?php

require_once('database.php');

class Service
{
    public string $nom;
    public string $description;
    public string $image;
    public string $descAdditional;
}

class servicesRepository
{

    private DatabaseConnection $connection;

    function __construct()
    {
        $this->connection = new DatabaseConnection;
    }

    function getServices(): array
    {
        $statement = $this->connection->getConnection()->prepare('SELECT nom, description, image, description_additional FROM services');
        $statement->execute();


        while ($service = $statement->fetch(pdo::FETCH_ASSOC)) {
            //We encode the image in base64 to display with img balise
            $service['image'] = base64_encode($service['image']);
            $services[] = $service;
        }

        return $services;
    }
}
