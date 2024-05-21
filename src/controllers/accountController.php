<?php

require_once('src/model/staffAccount.php');

function account()
{
    $username = $_POST['username'];

    $accountRepository = new AccountRepository;
    $account = $accountRepository->getUser($username);

    require('templates/account.php');
}
