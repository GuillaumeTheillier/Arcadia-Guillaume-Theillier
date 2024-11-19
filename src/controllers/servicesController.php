<?php

require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/../model/services.php');

function services()
{
    $servicesRepository = new ServicesRepository;
    $services = $servicesRepository->getServices();

    if (isset($_SESSION['LOGGED_USER']) && ($_SESSION['ROLE_USER'] === 3 || $_SESSION['ROLE_USER'] === 1)) {
        require(__DIR__ . '/../../templates/serviceManager.php');
    } else {
        require(__DIR__ . '/../../templates/services.php');
    }
}
