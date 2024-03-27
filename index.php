<?php

//require_once('templates/homepage.php');
require_once(__DIR__ . '/src/controllers/servicesController.php');
require_once(__DIR__ . '/src/controllers/homepageControllers.php');
require_once(__DIR__ . '/src/controllers/habitatsController.php');
require_once(__DIR__ . '/src/controllers/addCommentController.php');
require_once(__DIR__ . '/src/controllers/pageNotFoundController.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {

    $action = $_GET['action'];

    if ($action === 'addComment') {
        addComment($_POST);
    } else {
        try {
            $action();
        } catch (Error $e) {
            pageNotFound();
            //echo 'Page Introuvable';
        }
    }
} else {
    homepage();
}
