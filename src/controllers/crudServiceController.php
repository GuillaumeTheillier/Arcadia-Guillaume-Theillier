<?php

require_once('src/lib/functions.php');
require_once('src/lib/image.php');
require_once('src/model/services.php');

function servicesRepository()
{
    return $servicesRepository = new ServicesRepository;
}

function deleteService()
{
    $id = $_POST['deleteServiceId'];

    servicesRepository()->deleteService($id);

    //redirect to the service page
    redirectToUrl('index.php?action=services');
}

function createService()
{
    if (isset($_POST['createServiceTitle']) && isset($_POST['createServiceDescription'])) {

        $title = htmlspecialchars($_POST['createServiceTitle']);
        $description = nl2br(htmlspecialchars($_POST['createServiceDescription']));
        $descAdd = nl2br(htmlspecialchars($_POST['createServiceDescAdd']));

        try {
            $data = imageVerification($_FILES['createServiceImage']);

            $success = servicesRepository()->createService($title, $description, $data, $descAdd);
            setcookie(
                'CREATE_SERVICE_SUCCESS',
                $success,
                [
                    'expires' => time() + 10,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        } catch (Exception $e) {
            setcookie(
                'CREATE_SERVICE_ERROR',
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
            'CREATE_SERVICE_ERROR',
            'Toutes les entrées requises n\'ont pas été remplies',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
    //redirect to the service page
    redirectToUrl('index.php?action=services');
}

function updateService()
{
    if (isset($_POST['updateServiceId']) && isset($_POST['updateServiceTitle']) && isset($_POST['updateServiceDescription'])) {

        $id = (int)$_POST['updateServiceId'];
        $title = htmlspecialchars($_POST['updateServiceTitle']);
        $description = nl2br(htmlspecialchars($_POST['updateServiceDescription']));
        $descAdd = nl2br(htmlspecialchars($_POST['updateServiceDescAdd']));

        try {
            if ($_FILES['updateServiceImage']['error'] !== 4) {
                $data = imageVerification($_FILES['updateServiceImage']);
            } else {
                $data = '';
            }
            //var_dump([$id, $title, $description, $data, $descAdd]);
            //send information to modify them in database
            $success = servicesRepository()->updateService($id, $title, $description, $data, $descAdd);

            setcookie(
                'UPDATE_SERVICE_SUCCESS',
                $success,
                [
                    'expires' => time() + 2,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        } catch (Exception $e) {
            setcookie(
                'UPDATE_SERVICE_ERROR',
                $e->getMessage(),
                [
                    'expires' => time() + 2,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        }
    } else {
        setcookie(
            'UPDATE_SERVICE_ERROR',
            'Toutes les entrées requises n\'ont pas été remplies',
            [
                'expires' => time() + 2,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
    //redirect to the service page
    redirectToUrl('index.php?action=services');
}
