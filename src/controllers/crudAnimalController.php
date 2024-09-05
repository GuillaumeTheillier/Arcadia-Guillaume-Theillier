<?php
require_once('src/model/animals.php');
require_once('src/lib/image.php');
require_once('src/lib/functions.php');

function animalRepository()
{
    return new AnimalsRepository();
}

function createAnimal()
{
    $habitatId = $_COOKIE['CURRENT_HABITAT_ID'];
    //var_dump($_FILES['createAnimalImage']);
    if (isset($_POST['createAnimalName']) && isset($_FILES['createAnimalImage']) && !empty($_POST['createAnimalRace']) && !empty(isset($_POST['createAnimalHabitat']))) {
        $name = htmlspecialchars($_POST['createAnimalName']);
        $habitat = $_POST['createAnimalHabitat'];
        $race = $_POST['createAnimalRace'];

        try {
            $data = imageVerification($_FILES['createAnimalImage']);
            //var_dump($data);
            $success = animalRepository()->createAnimal($name, $data, $habitat, $race);
            //var_dump($success);
            setcookie(
                'CREATE_ANIMAL_SUCCESS',
                $success,
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        } catch (Exception $e) {
            setcookie(
                'CREATE_ANIMAL_ERROR',
                $e->getMessage(),
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        }
    }
    //redirect to the service page
    redirectToUrl('index.php?action=habitat&habitat=' . $habitatId);
}

function createRaceAnimal()
{
    if (isset($_POST['addRaceName'])) {
        $race = htmlspecialchars($_POST['addRaceName']);

        $success = animalRepository()->createRace($race);
        setcookie(
            'CREATE_RACE_ANIMAL_SUCCESS',
            $success,
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
}

function deleteAnimal()
{
    $habitatId = $_COOKIE['CURRENT_HABITAT_ID'];
    try {
        $id = $_POST['animalId'];
        $success = animalRepository()->deleteAnimal($id);
        setcookie(
            'DELETE_ANIMAL_SUCCESS',
            $success,
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    } catch (Error $e) {
        setcookie(
            'DELETE_ANIMAL_ERROR',
            $e->getMessage(),
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
    //redirect to the service page
    redirectToUrl('index.php?action=habitat&habitat=' . $habitatId);
}

//"index.php?action=habitat&habitatName=<?php echo $habitat['nom']";