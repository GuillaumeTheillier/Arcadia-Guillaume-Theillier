<?php

require_once('src/model/services.php');

function services()
{
    $servicesRepository = new servicesRepository;
    $services = $servicesRepository->getServices();

    require('templates/services.php');
}
