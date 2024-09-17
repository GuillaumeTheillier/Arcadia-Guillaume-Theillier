<?php

require_once('src/model/animals.php');
require_once('src/model/foodConsumption.php');

function animalConsumptionList()
{
    $id = $_GET['animal'];

    $animalRepository = new AnimalsRepository;
    $foodConsumptionRepository = new FoodConsumptionRepository;
    $animal = $animalRepository->getAnimal($id);
    $consumptionList = $foodConsumptionRepository->getConsumption($id);
    require('templates/animalConsumptionList.php');
}
