<?php
require_once(__DIR__ . '/../model/animals.php');
require_once(__DIR__ . '/../model/habitats.php');
require_once(__DIR__ . '/../lib/functions.php');

function animalList()
{
    if (isset($_SESSION['LOGGED_USER'])) {
        $animalRepository = new AnimalsRepository;
        $habitatRepository = new HabitatsRepository;
        $raceList = $animalRepository->getRace();
        $habitatList = $habitatRepository->getHabitatList();
        if (isset($_POST['animalListHabitatFilter'])) {
            $habitatId = $_POST['animalListHabitatFilter'];
            $filter['type'] = 'habitat';
            $filter['id'] = $habitatId;
            $animalList = $animalRepository->getAllAnimal($habitatId, 'habitat');
        } else if (isset($_POST['animalListRaceFilter'])) {
            $raceId = $_POST['animalListRaceFilter'];
            $filter['type'] = 'race';
            $filter['id'] = $raceId;
            $animalList = $animalRepository->getAllAnimal($raceId, 'race');
        } else {
            $filter['type'] = null;
            $filter['id'] = null;
            $animalList = $animalRepository->getAllAnimal();
        }
        require(__DIR__ . '/../../templates/animalListStaff.php');
    } else {
        redirectToUrl('index.php?action=homepage');
    }
}
