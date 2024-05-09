<?php

require_once('src/model/staffAccount.php');

function accountList()
{
    $accountRepository = new AccountRepository;
    $allAccount = $accountRepository->getAllUsers();

    require('templates/accountList.php');
}
