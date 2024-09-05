<?php

require_once('src/model/animals.php');

function animal(string $animalName)
{
    $animalRepository = new AnimalsRepository;
    $animal = $animalRepository->getAnimal($animalName);

    //Create cookie to save the current animal id
    setcookie(
        'CURRENT_ANIMAL_ID',
        $animal['id'],
        [
            'expires' => time() + 3600,
            'httponly' => true,
            'secure' => true
        ]
    );
    require('templates/animal.php');
}
