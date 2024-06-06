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
            $success = habitatRepository()->createHabitat($name, $description, $data);
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
    //redirectToUrl('index.php?action=habitatsList');
}
