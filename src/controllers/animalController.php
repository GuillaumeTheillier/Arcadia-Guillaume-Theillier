<?php

require_once(__DIR__ . '/../model/animals.php');

function animal(int $animalId)
{
    try {
        //Get all necessary data for animals and races
        $animalRepository = new AnimalsRepository;
        $animal = $animalRepository->getAnimal($animalId);
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

        if (!isset($_SESSION['LOGGED_USER'])) {
            $animalRepository->updateAnimalCountVisit($animalId);
        }
        require(__DIR__ . '/../../templates/animal.php');
    } catch (Error $e) {
        var_dump($e->getMessage());
    }
}

function updateAnimalForm(int $animalId)
{
    try {
        //Get data from database for habitat admin page 
        if (isset($_SESSION['LOGGED_USER']) && $_SESSION['ROLE_USER'] === 3) {
            //Get all necessary data for habitat
            $habitatRepository = new HabitatsRepository;
            $habitatList = $habitatRepository->getHabitatList();
            //Get all necessary data for animals and races
            $animalRepository = new AnimalsRepository;
            $animal = $animalRepository->getAnimal($animalId);
            $raceList = $animalRepository->getRace();

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
            require(__DIR__ . '/../../templates/updateAnimalForm.php');
        }
    } catch (Error $e) {
        var_dump($e->getMessage());
    }
}
