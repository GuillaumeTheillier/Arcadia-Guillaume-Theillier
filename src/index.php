<?php

//require_once('templates/homepage.php');
require_once('controllers/servicesController.php');
require_once('controllers\homepageControllers.php');
require_once('controllers/habitatsController.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
    $action = $_GET['action'];
    try {
        $action();
    } catch (Error $e) {
        echo 'Page Introuvable';
    }
} else {
    homepage();
}
