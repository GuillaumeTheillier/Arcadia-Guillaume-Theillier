<?php
require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/../model/veterinarianReport.php');
require_once(__DIR__ . '/../model/animals.php');

function veterinarianReport()
{
    return new VeterinarianReportRepository;
}

function addVeterinarianReport()
{
    if (isset($_POST['addReportStatus']) && isset($_POST['addReportFood']) && isset($_POST['addReportQuantity']) && isset($_POST['addReportDate'])) {
        $animalId = $_POST['animalId'];
        $username = $_SESSION['LOGGED_USER'];
        if (!ctype_space($_POST['addReportDate']) && !ctype_space($_POST['addReportFood']) && !ctype_space($_POST['addReportQuantity'])) {
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
                'Les champs ne doivent pas contenir uniquement des espaces.',
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        }
    } else {
        setcookie(
            'ADD_REPORT_ERROR',
            'Tous les champs ne sont pas remplis',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
    //var_dump($_SERVER['HTTP_REFERER']);
    //redirectToUrl('index.php?action=animalList');
    redirectToUrl($_SERVER['HTTP_REFERER']);
}

function veterinarianReportList()
{
    $reportRepository = veterinarianReport();
    $animalRepository = new AnimalsRepository;
    $animal = $animalRepository->getAllAnimal();

    if (!isset($_POST['reportListSort'])) {
        $sort = 'dateAsc';
    } else $sort = $_POST['reportListSort'];

    if (!isset($_POST['reportListAnimalFilter'])) {
        $animalId = null;
    } else $animalId = intval($_POST['reportListAnimalFilter']);

    if (!isset($_POST['reportListDateFilter']) || empty($_POST['reportListDateFilter'])) {
        $date = null;
    } else $date = $_POST['reportListDateFilter'];
    //clear Filter
    if (isset($_POST['clearFilter'])) {
        $date = null;
        $animalId = null;
    }
    $reportList = $reportRepository->getAllReport($sort, $animalId, $date);
    require(__DIR__ . '/../../templates/veterinarianReportList.php');
}
