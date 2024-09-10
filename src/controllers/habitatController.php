<?php
require_once('src/model/animals.php');
require_once('src/model/habitats.php');

function habitat(int $habitatTarget)
{
    try {
        //Get data from database for habitat admin page 
        if (isset($_SESSION['LOGGED_USER']) && $_SESSION['ROLE_USER'] === 3) {
            //Get all necessary data for habitat
            $habitatRepository = new HabitatsRepository;
            $habitat = $habitatRepository->getHabitat($habitatTarget);
            $habitatList = $habitatRepository->getHabitatList();
            //Get all necessary data for animals and races
            $animalsRepository = new AnimalsRepository;
            $raceList = $animalsRepository->getRace();
            $animals = $animalsRepository->getAllAnimalsInHabitat($habitatTarget);
            //Create cookie to save the current habitat id
            setcookie(
                'CURRENT_HABITAT_ID',
                $habitat['id'],
                [
                    'expires' => time() + 3600,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        } else {
            //Get data from database for habitat visitor, employee and veterinarian page 
            $habitatRepository = new HabitatsRepository;
            $habitat = $habitatRepository->getHabitat($habitatTarget);

            $animalsRepository = new AnimalsRepository;
            $animals = $animalsRepository->getAllAnimalsInHabitat($habitatTarget);
        }
        require('templates/habitat.php');
    } catch (Error $e) {
        // Affiche page 'Une erreur est survenue'.
        var_dump($e->getMessage());
    }
}
