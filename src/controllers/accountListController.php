<?php

require_once(__DIR__ . '/../model/staffAccount.php');

function accountList()
{
    isGranted('ROLE_ADMIN');
    $accountRepository = new AccountRepository;
    $allAccount = $accountRepository->getAllUsers();

    require(__DIR__ . '/../../templates/accountList.php');
}
