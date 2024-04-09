<?php
//phpinfo();
function sendContact()
{
    $mail = $_POST['emailContact'];
    $title = htmlspecialchars($_POST['titleContact']);
    $description = nl2br(htmlspecialchars($_POST['descriptionContact']));

    //check if mail is valid format and 
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
    }
    //check if the title and description input are not only space
    elseif (ctype_space($title) || ctype_space($description)) {
        setcookie(
            'CONTACT_ERROR',
            'Les champs titre et description sont invalides.',
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]

        );
    } else {

        $to = 'guillaumethlr@gmail.com';
        $header = 'FROM : ' . $mail;

        $success = mail($to, $title, $description, $header);

        setcookie(
            'CONTACT_SUCCESS',
            $success,
            [
                'httponly' => true,
                'secure' => true,
                'expires' => time() + 1
            ]
        );
    }
    //var_dump($success);
    header('Location: index.php?action=contact');
}
