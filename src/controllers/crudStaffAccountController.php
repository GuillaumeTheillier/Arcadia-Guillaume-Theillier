<?php
require_once(__DIR__ . '/../model/staffAccount.php');
require_once(__DIR__ . '/../lib/functions.php');

function createStaffAccount()
{
    isGranted('ROLE_ADMIN');
    $username = htmlspecialchars($_POST['username']);
    $surname = htmlspecialchars($_POST['surname']);
    $firstName = htmlspecialchars($_POST['firstName']);
    $role = $_POST['role'];
    $password = htmlspecialchars($_POST['password']);

    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        setcookie(
            'CREATE_ACCOUNT_ERROR',
            'email invalide',
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]
        );
        redirectToUrl('index.php?action=accountList');
    }
    if (ctype_space($surname) || ctype_space($firstName)) {

        setcookie(
            'CREATE_ACCOUNT_ERROR',
            'Le prénom et/ou le nom sont invalides',
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]
        );
        redirectToUrl('index.php?action=accountList');
    }

    $messagePassword = checkStrengthPassword($password);
    if ($messagePassword !== true) {
        setcookie(
            'CREATE_ACCOUNT_ERROR',
            $messagePassword,
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]
        );
        //var_dump(checkStrengthPassword($password));
        redirectToUrl('index.php?action=accountList');
    }

    $accountRepository = new AccountRepository;
    $password = password_hash($password, PASSWORD_BCRYPT);
    $success = $accountRepository->createAccount($username, $firstName, $surname, $password, $role);
    setcookie(
        'CREATE_ACCOUNT_SUCCESS',
        $success,
        [
            'httponly' => true,
            'secure' => true,
            'expires' => time() + 1
        ]
    );
    redirectToUrl('index.php?action=accountList');
}

/**
 * Update staff account
 */
function updateStaffAccount()
{
    isGranted('ROLE_ADMIN');
    $oldUsername = htmlspecialchars($_POST['oldUsername']);
    $newUsername = htmlspecialchars($_POST['newUsername']);
    $surname = htmlspecialchars($_POST['surname']);
    $firstName = htmlspecialchars($_POST['firstName']);
    $role = $_POST['role'];
    $password = htmlspecialchars($_POST['password']);
    var_dump($password);
    if (!filter_var($newUsername, FILTER_VALIDATE_EMAIL)) {
        setcookie(
            'UPDATE_ACCOUNT_ERROR',
            'email invalide',
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]
        );
        redirectToUrl('index.php?action=accountList');
    }
    if (ctype_space($surname) || ctype_space($firstName)) {

        setcookie(
            'UPDATE_ACCOUNT_ERROR',
            'Le prénom et/ou le nom sont invalides',
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]
        );
        redirectToUrl('index.php?action=accountList');
    }

    if ($password !== NULL && $password !== '') {
        $messagePassword = checkStrengthPassword($password);
        if ($messagePassword !== true) {
            setcookie(
                'UPDATE_ACCOUNT_ERROR',
                $messagePassword,
                [
                    'httponly' => true,
                    'secure' => true,
                    'expires' => time() + 1
                ]
            );
            redirectToUrl('index.php?action=accountList');
        }
        $password = password_hash($password, PASSWORD_BCRYPT);
    }

    $accountRepository = new AccountRepository;
    $success = $accountRepository->updateAccount($oldUsername, $newUsername, $firstName, $surname, $password, $role);

    setcookie(
        'UPDATE_ACCOUNT_SUCCESS',
        $success,
        [
            'httponly' => true,
            'secure' => true,
            'expires' => time() + 1
        ]
    );
    redirectToUrl('index.php?action=accountList');
}

/**
 * Check if the password contains at least eigth caractere, one lowercase, one uppercase and one digit
 * 
 * @return bool|string True on strong password or string with the reason of the password weakness  
 */
function checkStrengthPassword($password): string|bool
{
    if (strlen($password) < 8) {
        return 'Mot de passe trop court';
    }

    $masque1 = "/[A-Z].*?[a-z]|[a-z].*?[A-Z]/";
    $masque2 = "/[a-zA-z].[0-9]|[0-9].[a-zA-z]/";
    if (preg_match($masque1, $password) === 0) {
        return 'Veuillez vérifier que le mot de passe possède au moins 1 majuscule, 1 minuscule et 1 chiffre.';
    }
    if (preg_match($masque2, $password) === 0) {
        return 'Veuillez vérifier que le mot de passe possède au moins 1 chiffre.';
    }
    return true;
}

function deleteStaffAccount()
{
    isGranted('ROLE_ADMIN');
    $username = $_POST['username'];
    $accountRepository = new AccountRepository;
    $accountRepository->deleteAccount($username);
    redirectToUrl('index.php?action=accountList');
}
