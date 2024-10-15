<?php

require_once('src/model/staffAccount.php');
require_once('src\lib\functions.php');

function dashboard()
{
    $usersRepository = new AccountRepository;
    $users = $usersRepository->getAllUsers();
    require('templates/dashboardAdmin.php');
}
