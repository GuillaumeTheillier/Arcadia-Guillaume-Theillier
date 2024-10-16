<?php

require_once('src/model/staffAccount.php');
require_once('src/model/schedule.php');
require_once('src/model/animals.php');
require_once('src\lib\functions.php');

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
    require('templates/dashboardAdmin.php');
}
