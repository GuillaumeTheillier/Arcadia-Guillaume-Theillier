<?php
require_once('src/model/habitats.php');
require_once('src/lib/image.php');
require_once('src/lib/functions.php');

function habitatRepository()
{
    return new HabitatsRepository();
}

function createHabitat()
{
    if (isset($_POST['createHabitatName']) && isset($_POST['createHabitatDescription'])) {
        $name = htmlspecialchars($_POST['createHabitatName']);
        $description = nl2br(htmlspecialchars($_POST['createHabitatDescription']));

        try {
            $data = imageVerification($_FILES['createHabitatImage']);
            //var_dump($data);
            $success = habitatRepository()->createHabitat($name, $description, $data);
            //var_dump($success);
            setcookie(
                'CREATE_HABITAT_SUCCESS',
                $success,
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        } catch (Exception $e) {
            //var_dump($e->getMessage());
            setcookie(
                'CREATE_HABITAT_ERROR',
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

function deleteHabitat()
{
    $id = $_POST['habitatId'];
    try {
        $success = habitatRepository()->deleteHabitat($id);
        setcookie(
            'DELETE_HABITAT_SUCCESS',
            $success,
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    } catch (Error $e) {
        setcookie(
            'DELETE_HABITAT_ERROR',
            $e->getMessage(),
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
    //redirect to the service page
    redirectToUrl('index.php?action=habitatsList');
}

function updateHabitat()
{
    $habitatId = $_POST['updateHabitatId'];
    if (isset($_POST['updateHabitatName']) && isset($_POST['updateHabitatDescription'])) {
        $name = htmlspecialchars($_POST['updateHabitatName']);
        $description = nl2br(htmlspecialchars($_POST['updateHabitatDescription']));
        try {
            //Image is optional
            //If image is modified then add him in the function argument
            if (isset($_FILES['updateHabitatImage']) && $_FILES['updateHabitatImage']['error'] !== 4) {
                $data = imageVerification($_FILES['updateHabitatImage']);
                $success = habitatRepository()->updateHabitat($habitatId, $name, $description, $data);
            } else {
                $success = habitatRepository()->updateHabitat($habitatId, $name, $description);
            }
            setcookie(
                'UPDATE_HABITAT_SUCCESS',
                $success,
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
            //Redirect to the list of habitats page
            redirectToUrl('index.php?action=habitatsList');
        } catch (Exception $e) {
            //var_dump($e->getMessage());
            setcookie(
                'UPDATE_HABITAT_ERROR',
                $e->getMessage(),
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
            //Redirect to the list of habitats page
            redirectToUrl('index.php?action=updateHabitatForm&habitat=' . $habitatId);
        }
    } else {
        setcookie(
            'UPDATE_HABITAT_ERROR',
            'Tous les champs n\'ont pas été saisis.',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
        //Redirect to the update habitat page
        redirectToUrl('index.php?action=updateHabitatForm&habitat=' . $habitatId);
    }
}
