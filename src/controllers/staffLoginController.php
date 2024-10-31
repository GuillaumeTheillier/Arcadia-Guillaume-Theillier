<?php
require_once('src/model/staffAccount.php');
require_once('src/lib/functions.php');

function staffLogin()
{
    require('templates/staffLogin.php');
}

function login()
{
    if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
        $username = htmlspecialchars($_POST['loginUsername']);
        $password = htmlspecialchars($_POST['loginPassword']);

        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            setcookie(
                'LOGIN_ERROR',
                'Nom d\'utilisateur incorrect',
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
            if (!$login->usernameExist($username)) {
                //throw new Exception('Ce nom d\'utilisateur n\'existe pas');
                setcookie(
                    'LOGIN_ERROR',
                    'Ce nom d\'utilisateur n\'existe pas',
                    [
                        'expires' => time() + 1,
                        'httponly' => true,
                        'secure' => true
                    ]
                );

                redirectToUrl('index.php?action=staffLogin');
            }
            if (!$user = $login->verifyPassword($username, $password)) {
                //throw new Exception('Mot de passe incorrect');
                setcookie(
                    'LOGIN_ERROR',
                    'Mot de passe incorrect',
                    [
                        'expires' => time() + 1,
                        'httponly' => true,
                        'secure' => true
                    ]
                );

                redirectToUrl('index.php?action=staffLogin');
            }
            $_SESSION['LOGGED_USER'] = $user['username'];
            /*
                0 = Visitor
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
