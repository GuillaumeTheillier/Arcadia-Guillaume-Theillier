<?php

require_once(__DIR__ . '/../model/staffAccount.php');

function updateAccount()
{
    isGranted('ROLE_ADMIN');
    $username = $_POST['username'];

    $accountRepository = new AccountRepository;
    $account = $accountRepository->getUser($username);

    require(__DIR__ . '/../../templates/updateAccount.php');
}
