<?php

/*set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    //Redirect to error page
    if ($errno === E_WARNING) {
        // pageNotFound();
    }
    echo "<b>Error:</b> [$errno] $errstr<br>";
    echo " Error on line $errline in $errfile<br>";
    //pageNotFound();
    //exit();
});

set_exception_handler(function ($errno, $errstr, $errfile, $errline) {
    //pageNotFound();
});*/

require_once 'requireAllControllers.php';
/*
if (isset($_GET['action']) && $_GET['action'] !== '') {
    /*
    $action = $_GET['action'];
    if ($action === 'addComment') {
        addComment($_POST);
    } elseif (isset($_GET['habitat']) && is_numeric($_GET['habitat'])) {
        $habitatId = $_GET['habitat'];
        $action($habitatId);
    } elseif (isset($_GET['animal']) && is_numeric($_GET['animal'])) {
        $animalId = $_GET['animal'];
        $action($animalId);
    } else {
        $action();
    }

    //if there are an error return unfound page
    try {
        $action = $_GET['action'];
        if ($action === 'addComment') {
            addComment($_POST);
        } elseif (isset($_GET['habitat']) && is_numeric($_GET['habitat'])) {
            $habitatId = $_GET['habitat'];
            $action($habitatId);
        } elseif (isset($_GET['animal']) && is_numeric($_GET['animal'])) {
            $animalId = $_GET['animal'];
            $action($animalId);
        } else {
            $action();
        }
    } catch (Error $e) {
        pageNotFound();
    }
} else {
    homepage();
}
*/