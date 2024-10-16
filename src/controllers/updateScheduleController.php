<?php

require_once('src/model/schedule.php');
require_once('src/lib/functions.php');

function updateSchedule()
{
    $scheduleRepository = new ScheduleRepository;

    $input = $_POST;
    $masque = "%^[[:digit:]].\:.[[:digit:]]$%";
    $res = preg_grep($masque, $input);

    if (count($res) === 14) {
        $success = $scheduleRepository->updateSchedule($res);
        if ($success) {
            setcookie(
                'UPDATE_SCHEDULE_SUCCESS',
                $success,
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        } else {
            setcookie(
                'UPDATE_SCHEDULE_ERROR',
                'Une erreur est survenue.',
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        }
    } else {
        setcookie(
            'UPDATE_SCHEDULE_ERROR',
            'Les entrées saisient ne sont pas valides.',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
    redirectToUrl('index.php?action=dashboard');
}
