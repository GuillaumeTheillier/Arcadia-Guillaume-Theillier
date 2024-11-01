<?php
require_once('src\model\foodConsumption.php');

function foodConsumptionRepository()
{
    return $foodConsumptionRepository = new FoodConsumptionRepository;
}
/*
function foodConsumptionForm()
{
    if (isset($_POST['animalId'])) {
        $animalId = $_POST['animalId'];
    } else if (isset($_COOKIE['ANIMAL_ID'])) {
        $animalId =  $_COOKIE['ANIMAL_ID'];
    } else {
        setcookie(
            'ADD_FOOD_ERROR',
            'Une erreur est survenue.',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
        //Redirect to the animal list page
        redirectToUrl('index.php?action=animalList');
    }
    //Save animal id for few minutes if they are an error 
    setcookie(
        'ANIMAL_ID',
        $animalId,
        [
            'expires' => time() + 300,
            'httponly' => true,
            'secure' => true
        ]
    );
    require('templates/foodConsumptionForm.php');
}*/

function addFoodConsumption()
{
    if (isset($_POST['foodDate']) && isset($_POST['foodType']) && isset($_POST['foodQuantity'])) {
        $username = $_SESSION['LOGGED_USER'];
        $animalId = $_POST['animalId'];
        if (!ctype_space($_POST['foodDate']) && !ctype_space($_POST['foodType']) && !ctype_space($_POST['foodQuantity'])) {
            $date = $_POST['foodDate'];
            $foodType = htmlspecialchars($_POST['foodType']);
            $quantity = htmlspecialchars($_POST['foodQuantity']);

            $success = foodConsumptionRepository()->addConsumption($date, $foodType, $quantity, $username, $animalId);
            setcookie(
                'ADD_FOOD_SUCCESS',
                $success,
                [
                    'expires' => time() + 2,
                    'httponly' => true,
                    'secure' => true
                ]
            );
            //Redirect to the animal list page
            redirectToUrl('index.php?action=animalList');
        } else {
            setcookie(
                'ADD_FOOD_ERROR',
                'Tous les champs doivent être remplis.',
                [
                    'expires' => time() + 2,
                    'httponly' => true,
                    'secure' => true
                ]
            );
            //Redirect to the add food page
            redirectToUrl('index.php?action=foodConsumptionForm');
        }
    } else {
        setcookie(
            'ADD_FOOD_ERROR',
            'Tous les champs n\'ont pas été saisis.',
            [
                'expires' => time() + 2,
                'httponly' => true,
                'secure' => true
            ]
        );
        //Redirect to the add food page
        redirectToUrl('index.php?action=foodConsumptionForm');
    }
}
