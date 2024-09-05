<?php
require_once('src/model/animals.php');
require_once('src/model/habitats.php');

function habitat(int $habitatTarget)
{
    try {
        $habitatRepository = new HabitatsRepository;
        $habitat = $habitatRepository->getHabitat($habitatTarget);

        $animalsRepository = new AnimalsRepository;
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

        require('templates/habitat.php');
    } catch (Error $e) {
        var_dump($e->getMessage());
    }
}
