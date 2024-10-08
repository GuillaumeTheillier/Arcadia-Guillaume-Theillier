<?php

require_once('src/model/database.php');
require_once('src/model/schedule.php');

function practicalInformation()
{
    $scheduleRepository = new ScheduleRepository;
    $schedule = $scheduleRepository->getSchedule();
    require('templates/practicalInformation.php');
}
