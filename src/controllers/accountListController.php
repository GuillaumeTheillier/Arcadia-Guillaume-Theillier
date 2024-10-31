<?php

require_once(__DIR__ . '/../model/staffAccount.php');

function accountList()
{
    $accountRepository = new AccountRepository;
    $allAccount = $accountRepository->getAllUsers();

    require('templates/accountList.php');
}
