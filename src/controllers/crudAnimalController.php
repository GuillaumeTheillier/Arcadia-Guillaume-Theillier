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
    if (isset($_POST['createAnimalName']) && isset($_POST['createAnimalImage'])) {
        $name = htmlspecialchars($_POST['createHabitatName']);
        $habitat = $_POST['createAnimalIdHabitat'];
        $race = $_POST['createAnimalIdRace'];

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
    //Redirect to habitats list page
    redirectToUrl('index.php?action=habitatsList');
}

function createRace()
{
    if (isset($_POST['addRaceName'])) {
        $race = htmlspecialchars($_POST['addRaceName']);

        $success = animalRepository()->addRace($race);
        setcookie(
            'CREATE_ANIMAL_SUCCESS',
            $success,
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
}
