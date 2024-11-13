<?php

require_once(__DIR__ . '/../model/animals.php');
require_once(__DIR__ . '/../model/foodConsumption.php');

function animalConsumptionList()
{
    $id = $_GET['animal'];

    $animalRepository = new AnimalsRepository;
    $foodConsumptionRepository = new FoodConsumptionRepository;
    $animal = $animalRepository->getAnimal($id);
    $consumptionList = $foodConsumptionRepository->getConsumption($id);
    require(__DIR__ . '/../../templates/animalConsumptionList.php');
}
