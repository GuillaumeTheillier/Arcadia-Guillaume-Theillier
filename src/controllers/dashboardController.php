<?php

require_once('src/model/staffAccount.php');

function dashboard()
{
    switch ($_SESSION['ROLE_USER']) {
        case 1:
            require('templates/dashboardEmployee.php');
            break;
        case 2:
            require('templates/dashboardVeterinarian.php');
            break;
        case 3:
            $usersRepository = new AccountRepository;
            $users = $usersRepository->getAllUsers();
            require('templates/dashboardAdmin.php');
            break;
    }
}
