<?php

require_once(__DIR__ . '/../model/database.php');
require_once(__DIR__ . '/../model/schedule.php');

function practicalInformation()
{
    $scheduleRepository = new ScheduleRepository;
    $schedule = $scheduleRepository->getSchedule();
    require('templates/practicalInformation.php');
}
