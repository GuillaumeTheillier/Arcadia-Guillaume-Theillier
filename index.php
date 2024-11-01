<?php
session_start();
/*
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    //Redirect to error page
    if ($errno === E_WARNING) {
        //exit();
        pageNotFound();
        exit();
    }
    pageNotFound();
    //exit();
});

set_exception_handler(function ($errno, $errstr, $errfile, $errline) {
    pageNotFound();
});*/

require_once(__DIR__ . '/src/controllers/servicesController.php');
require_once(__DIR__ . '/src/controllers/homepageControllers.php');
require_once(__DIR__ . '/src/controllers/habitatsListController.php');
require_once(__DIR__ . '/src/controllers/addCommentController.php');
require_once(__DIR__ . '/src/controllers/pageNotFoundController.php');
require_once(__DIR__ . '/src/controllers/habitatController.php');
require_once(__DIR__ . '/src/controllers/animalController.php');
require_once(__DIR__ . '/src/controllers/practicalInformationController.php');
require_once(__DIR__ . '/src/controllers/contactController.php');
require_once(__DIR__ . '/src/controllers/sendContactController.php');
require_once(__DIR__ . '/src/controllers/staffLoginController.php');
require_once(__DIR__ . '/src/controllers/dashboardController.php');
require_once(__DIR__ . '/src/controllers/commentManagerController.php');
require_once(__DIR__ . '/src/controllers/accountListController.php');
require_once(__DIR__ . '/src/controllers/crudStaffAccountController.php');
require_once(__DIR__ . '/src/controllers/accountController.php');
require_once(__DIR__ . '/src/controllers/crudServiceController.php');
require_once(__DIR__ . '/src/controllers/crudHabitatController.php');
require_once(__DIR__ . '/src/controllers/crudAnimalController.php');
require_once(__DIR__ . '/src/controllers/foodConsumptionController.php');
require_once(__DIR__ . '/src/controllers/animalListStaffController.php');
require_once(__DIR__ . '/src/controllers/animalConsumptionListController.php');
require_once(__DIR__ . '/src/controllers/veterinarianReportController.php');
require_once(__DIR__ . '/src/controllers/addHabitatCommentController.php');
require_once(__DIR__ . '/src/controllers/habitatCommentController.php');
require_once(__DIR__ . '/src/controllers/updateScheduleController.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {

    $action = $_GET['action'];
    if ($action === 'addComment') {
        addComment($_POST);
    } elseif (/*$action === 'habitat' &&*/isset($_GET['habitat']) && is_numeric($_GET['habitat'])) {
        $habitatId = $_GET['habitat'];
        $action($habitatId);
    } elseif (/*$action === 'animal' &&*/isset($_GET['animal']) && is_numeric($_GET['animal'])) {
        $animalId = $_GET['animal'];
        $action($animalId);
    } else {
        $action();
    }

    //if there are an error return unfound page 
    /*try {
        if ($action === 'addComment') {
            addComment($_POST);
        } elseif ($action === 'habitat' && isset($_GET['habitatName'])) {
            $habitatName = $_GET['habitatName'];
            habitat($habitatName);
        } elseif ($action === 'animal' && isset($_GET['animalName'])) {
            $animalName = $_GET['animalName'];
            animal($animalName);
        } else {
            $action();
        }
    } catch (Error $e) {
        pageNotFound();
    }*/
} else {
    homepage();
}
