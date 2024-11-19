<?php

require_once(__DIR__ . '/../model/staffAccount.php');
require_once(__DIR__ . '/../model/schedule.php');
require_once(__DIR__ . '/../model/animals.php');
require_once(__DIR__ . '/../lib/functions.php');

function dashboard()
{
    //user list
    $usersRepository = new AccountRepository;
    $users = $usersRepository->getAllUsers();
    //schedule
    $scheduleRepository = new ScheduleRepository;
    $schedule = $scheduleRepository->getSchedule();
    //animal count visit
    $animalRepository = new AnimalsRepository;
    $animalVisit = $animalRepository->getAnimalCountVisit();
    require(__DIR__ . '/../../templates/dashboardAdmin.php');
}
