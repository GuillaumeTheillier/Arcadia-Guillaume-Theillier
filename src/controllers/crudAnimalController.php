<?php
require_once('src/model/animals.php');
require_once('src/lib/image.php');
require_once('src/lib/functions.php');
require_once('addRaceController.php');

function animalRepository()
{
    return new AnimalsRepository();
}

/**
 * Create animal in database and redirect to the page of habitat who user create animal
 */
function createAnimal()
{
    $currentHabId = $_COOKIE['CURRENT_HABITAT_ID'];
    if (isset($_POST['createAnimalName']) && isset($_FILES['createAnimalImage']) && is_numeric($_POST['createAnimalHabitat'])) {
        $name = htmlspecialchars($_POST['createAnimalName']);
        $habitatId = (int)$_POST['createAnimalHabitat'];

        try {
            if (isset($_POST['createAnimalRace']) && is_numeric($_POST['createAnimalRace'])) {
                $raceId = $_POST['createAnimalRace'];
            } else if (isset($_POST['createAnimalAddRace']) && is_string($_POST['createAnimalAddRace'])) {
                $race = htmlspecialchars($_POST['createAnimalAddRace']);
                $raceId = addRace($race);
            } else {
                throw new Exception('La race est invalide');
            }
            $data = imageVerification($_FILES['createAnimalImage']);
            $success = animalRepository()->createAnimal($name, $data, $habitatId, $raceId);
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
    } else {
        setcookie(
            'CREATE_ANIMAL_ERROR',
            'Toutes les entrées n\'ont pas été saisies',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
    //redirect to the service page
    redirectToUrl('index.php?action=habitat&habitat=' . $currentHabId);
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

function updateAnimal()
{
    $habitatId = $_COOKIE['CURRENT_HABITAT_ID'];
    $animalId = $_POST['updateAnimalId'];
    if (isset($_POST['updateAnimalName']) && is_numeric($_POST['updateAnimalHabitat'])) {
        $name = htmlspecialchars($_POST['updateAnimalName']);
        $habitat = (int)$_POST['updateAnimalHabitat'];
        try {
            //Create new race that is necessary
            if (isset($_POST['updateAnimalRace']) && is_numeric($_POST['updateAnimalRace'])) {
                $raceId = $_POST['updateAnimalRace'];
            } else if (isset($_POST['updateAnimalAddRace']) && is_string($_POST['updateAnimalAddRace'])) {
                $race = htmlspecialchars($_POST['updateAnimalAddRace']);
                $raceId = addRace($race);
            } else {
                throw new Exception('La race est invalide');
            }
            //Call function to update animal from the model
            if (isset($_FILES['updateAnimalImage']) && $_FILES['updateAnimalImage']['error'] !== 4) {
                $data = imageVerification($_FILES['updateAnimalImage']);
                $success = animalRepository()->updateAnimal($animalId, $name, $habitat, $raceId, $data);
            } else {
                $success = animalRepository()->updateAnimal($animalId, $name, $habitat, $raceId);
            }
            setcookie(
                'UPDATE_ANIMAL_SUCCESS',
                $success,
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
            //Redirect to the habitat page
            redirectToUrl('index.php?action=habitat&habitat=' . $habitatId);
        } catch (Exception $e) {
            setcookie(
                'UPDATE_ANIMAL_ERROR',
                $e->getMessage(),
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
            //Redirect to the update animal page
            redirectToUrl('index.php?action=updateAnimalForm&animal=' . $animalId);
        }
    } else {
        setcookie(
            'UPDATE_ANIMAL_ERROR',
            'Tous les champs n\'ont pas été saisis.',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
        //Redirect to the update animal page
        redirectToUrl('index.php?action=updateAnimalForm&animal=' . $animalId);
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