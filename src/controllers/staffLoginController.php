<?php
require_once(__DIR__ . '/../model/staffAccount.php');
require_once(__DIR__ . '/../lib/functions.php');

function staffLogin()
{
    require(__DIR__ . '/../../templates/staffLogin.php');
}

function login()
{
    if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
        $username = htmlspecialchars($_POST['loginUsername']);
        $password = htmlspecialchars($_POST['loginPassword']);

        //Check if it's a valid email in input
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            setcookie(
                'LOGIN_ERROR',
                'Nom d\'utilisateur incorrect et/ou mot de passe incorrect',
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
            redirectToUrl('index.php?action=staffLogin');
        } else {
            //Instanciate users class
            $login = new AccountRepository;
            //Check if username exists
            if (!$login->usernameExist($username)) {
                setcookie(
                    'LOGIN_ERROR',
                    'Nom d\'utilisateur incorrect et/ou mot de passe incorrect',
                    [
                        'expires' => time() + 1,
                        'httponly' => true,
                        'secure' => true
                    ]
                );

                redirectToUrl('index.php?action=staffLogin');
            }
            //Compare the hash of the password in database and the form.
            $user = $login->verifyPassword($username, $password);
            if (!$user) {
                setcookie(
                    'LOGIN_ERROR',
                    'Nom d\'utilisateur incorrect et/ou mot de passe incorrect',
                    [
                        'expires' => time() + 1,
                        'httponly' => true,
                        'secure' => true
                    ]
                );

                redirectToUrl('index.php?action=staffLogin');
            } else {
                $_SESSION['LOGGED_USER'] = $user['username'];
                /*
                1 = employee
                2 = veterinarian
                3 = admin
                */
                $_SESSION['ROLE_USER'] = $user['role'];
                if ($user['role'] === 3) {
                    redirectToUrl('index.php?action=dashboard');
                } else redirectToUrl('index.php?action=animalList');
            }
        }
    }
}



function logout()
{
    //Destroy current session with session variables
    session_unset();
    session_destroy();
    //Set a temporary cookie for notify user is correctly logout
    setcookie(
        'LOGOUT_MESSAGE',
        true,
        [
            'expires' => time() + 1,
            'httponly' => true,
            'secure' => true
        ]
    );
    redirectToUrl('index.php');
}
