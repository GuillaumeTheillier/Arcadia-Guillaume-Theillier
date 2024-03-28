<?php

require_once('src/model/animals.php');
require_once('src/model/habitats.php');

function habitat($habitatTarget)
{

    $habitatRepository = new HabitatsRepository;
    $habitat = $habitatRepository->getHabitat($habitatTarget);

    $animalsRepository = new AnimalsRepository;
    $animals = $animalsRepository->getAllAnimalsInHabitat($habitatTarget);

    require('templates/habitat.php');
}
