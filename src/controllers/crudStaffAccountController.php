<?php
require_once('src/model/staffAccount.php');
require_once('src/lib/functions.php');

function createStaffAccount()
{
    $username = htmlspecialchars($_POST['username']);
    $surname = htmlspecialchars($_POST['surname']);
    $firstName = htmlspecialchars($_POST['firstName']);
    $role = $_POST['role'];
    //$password = htmlspecialchars($_POST['password']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        setcookie(
            'ACCOUNT_ERROR',
            'email invalide',
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]
        );
        redirectToUrl('index.php?action=accountList');
    }
    if (ctype_space($surname) && ctype_space($firstName)) {

        setcookie(
            'ACCOUNT_ERROR',
            'Le prénom et|ou le nom sont invalides',
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]
        );
        redirectToUrl('index.php?action=accountList');
    }
    /*if ($message = checkStrengthPassword($password) !== null) {
        setcookie(
            'ACCOUNT_ERROR',
            $message,
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]
        );
        var_dump(checkStrengthPassword($password));
        //redirectToUrl('index.php?action=accountList');
    }*/

    $accountRepository = new AccountRepository;
    $accountRepository->createAccount($username, $firstName, $surname, $password, $role);


    redirectToUrl('index.php?action=accountList');
}

function checkStrengthPassword($password)
{
    if (strlen($password) < 8) {
        return 'Mot de passe trop court';
    }

    $masque = "/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])/";

    if (preg_match($masque, $password) === 0) {
        return 'Veuillez vérifier que le mot de passe possède au moins 1 majuscule, 1 minuscule et 1 chiffre';
    }

    return null;
}

function deleteStaffAccount()
{
    $username = $_POST['username'];

    $accountRepository = new AccountRepository;
    $accountRepository->deleteAccount($username);

    redirectToUrl('index.php?action=accountList');
}
