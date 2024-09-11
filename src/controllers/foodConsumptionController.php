<?php
require_once('src\model\foodConsumption.php');

function foodConsumptionRepository()
{
    return $foodConsumptionRepository = new FoodConsumptionRepository;
}

function foodConsumptionForm()
{
    require('templates/foodConsumptionForm.php');
}

function addFoodConsumption()
{
    if (isset($_POST['foodDate']) && isset($_POST['foodType']) && isset($_POST['foodQuantity'])) {
        $date = $_POST['foodDate'];
        $foodType = htmlspecialchars($_POST['foodType']);
        $quantity = htmlspecialchars($_POST['foodQuantity']);
        $username = $_SESSION['LOGGED_USER'];
        $animalId = $_POST['animalId'];
        //var_dump($date);
        foodConsumptionRepository()->addConsumption($date, $foodType, $quantity, $username, $animalId);
        //Redirect to the animal page
        redirectToUrl('index.php?action=habitatsList');
    } else {
        setcookie(
            'ADD_FOOD_ERROR',
            'Tous les champs n\'ont pas été saisis',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
        //Redirect to the add food page
        redirectToUrl('index.php?action=foodConsumptionForm');
    }
}
