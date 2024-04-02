<?php

function sendContact()
{
    $mail = $_POST['emailContact'];
    $title = $_POST['titleContact'];
    $description = htmlspecialchars($_POST['descriptionContact']);

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        setcookie(
            'CONTACT_ERROR',
            'email invalides',
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]

        );
    } else {
        setcookie(
            'CONTACT_SUCCESS',
            true,
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]

        );

        setcookie(
            'CONTACT_DESC',
            $description,
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]

        );
    }

    header('Location: index.php?action=contact');
}
