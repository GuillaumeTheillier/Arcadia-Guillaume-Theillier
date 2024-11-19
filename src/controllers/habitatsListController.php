<?php

require_once(__DIR__ . '/../model/habitats.php');

function habitatsList()
{
    // $maraisImg = '/src/model\images\homepage\pexels-henning-roettger-2100047.jpg';
    // $jungleImg = '/src/model\images\homepage\zoo-4007318_1280.jpg';
    // $savaneImg = '/src/model\images\homepage\suricate.jpg';

    $habitatsRepository = new HabitatsRepository;
    $habitats = $habitatsRepository->getAllHabitats();

    require(__DIR__ . '/../../templates/habitatsList.php');
}

function updateHabitatForm(int $habitatId)
{
    $habitatRepository = new HabitatsRepository;
    $habitat = $habitatRepository->getHabitat($habitatId);

    require(__DIR__ . '/../../templates/updateHabitatForm.php');
}
