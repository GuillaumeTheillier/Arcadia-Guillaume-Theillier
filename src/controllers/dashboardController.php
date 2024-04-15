<?php

require_once('src/model/staffLogin.php');

function dashboard(): never
{
    $usersRepository = new Users;
    $users = $usersRepository->getAllUsers();

    require('templates/dashboard.php');
}
