<?php
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

require_once 'requireAllControllers.php';

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
