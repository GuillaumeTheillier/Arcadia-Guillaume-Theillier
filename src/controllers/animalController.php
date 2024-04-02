<?php

require_once('src/model/animals.php');

function animal(string $animalName)
{
    $animalRepository = new AnimalsRepository;
    $animal = $animalRepository->getAnimal($animalName);

    require('templates/animal.php');
}
