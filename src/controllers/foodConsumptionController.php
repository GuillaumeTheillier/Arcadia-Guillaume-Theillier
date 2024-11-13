<?php
require_once(__DIR__ . '/../model\foodConsumption.php');

function foodConsumptionRepository()
{
    return $foodConsumptionRepository = new FoodConsumptionRepository;
}

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
