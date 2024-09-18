<?php
require_once('src/lib/functions.php');
require_once('src/model/veterinarianReport.php');

function veterinarianReport()
{
    return new VeterinarianReportRepository;
}

function addAnimalReport()
{
    if (isset($_POST['addReportStatus']) && isset($_POST['addReportFood']) && isset($_POST['addReportQuantity']) && isset($_POST['addReportDate'])) {
        $animalId = $_POST['animalId'];
        $username = $_SESSION['LOGGED_USER'];

        $status = htmlspecialchars($_POST['addReportStatus']);
        $food = htmlspecialchars($_POST['addReportFood']);
        $quantity = htmlspecialchars(($_POST['addReportQuantity']));
        $date = htmlspecialchars($_POST['addReportDate']);
        $statusDetail = null;
        if (isset($_POST['addReportStatusDetail']) && !empty($_POST['addReportStatusDetail'])) {
            $statusDetail = htmlspecialchars($_POST['addReportStatusDetail']);
        }

        $success = veterinarianReport()->addReport($date, $status, $food, $quantity, $username, $animalId, $statusDetail);
        setcookie(
            'ADD_REPORT_SUCCESS',
            $success,
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    } else {
        setcookie(
            'ADD_REPORT_ERROR',
            'Une erreur est survenue lors de la transmission des données.',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
    redirectToUrl('index.php?action=animalList');
}
