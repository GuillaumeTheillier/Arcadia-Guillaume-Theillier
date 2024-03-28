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

require_once(__DIR__ . '/src/controllers/servicesController.php');
require_once(__DIR__ . '/src/controllers/homepageControllers.php');
require_once(__DIR__ . '/src/controllers/habitatsListController.php');
require_once(__DIR__ . '/src/controllers/addCommentController.php');
require_once(__DIR__ . '/src/controllers/pageNotFoundController.php');
require_once(__DIR__ . '/src/controllers/habitatController.php');
require_once(__DIR__ . '/src/controllers/animalController.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {

    $action = $_GET['action'];

    //if there are an error return unfound page
    try {
        if ($action === 'addComment') {
            addComment($_POST);
        } elseif ($action === 'habitat' && isset($_GET['name'])) {
            $habitatName = $_GET['name'];
            habitat($habitatName);
        } else {
            $action();
        }
    } catch (Error $e) {
        pageNotFound();
    }
} else {
    homepage();
}
