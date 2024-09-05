<?php

require_once('src/model/staffAccount.php');

function updateAccount()
{
    $username = $_POST['username'];

    $accountRepository = new AccountRepository;
    $account = $accountRepository->getUser($username);

    require('templates/updateAccount.php');
}
