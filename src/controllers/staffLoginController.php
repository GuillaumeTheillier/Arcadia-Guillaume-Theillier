<?php

require_once('src/model/staffLogin.php');

function staffLogin()
{
    require('templates/staffLogin.php');
}

function login()
{
    if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
        $username = htmlspecialchars($_POST['loginUsername']);
        $password = htmlspecialchars($_POST['loginPassword']);

        $login = new Login;
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

            header('Location: index.php?action=staffLogin');
        }


        if (!$login->verifyPassword($username, $password)) {
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

            header('Location: index.php?action=staffLogin');
        }
    }
    echo 'connexion réussie';
    //header('Location: index.php?action=staffLogin');
}
