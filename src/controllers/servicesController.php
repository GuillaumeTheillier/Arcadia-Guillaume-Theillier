<?php

require_once('src/model/services.php');

function servicesRepository()
{
    $servicesRepository = new ServicesRepository;

    return $servicesRepository;
}

function services()
{
    $services = servicesRepository()->getServices();

    require('templates/services.php');
}

function editService()
{
}

function deleteService()
{
    $id = $_POST['serviceTitle'];

    var_dump($id);
}

function newService()
{
}
