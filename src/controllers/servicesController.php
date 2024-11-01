<?php

require_once('src/lib/functions.php');
require_once('src/model/services.php');

function services()
{
    $servicesRepository = new ServicesRepository;
    $services = $servicesRepository->getServices();

    if (isset($_SESSION['LOGGED_USER']) && ($_SESSION['ROLE_USER'] === 3 || $_SESSION['ROLE_USER'] === 1)) {
        require('templates/serviceManager.php');
    } else {
        require('templates/services.php');
    }
}
