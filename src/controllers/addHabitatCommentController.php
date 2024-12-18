<?php
require_once(__DIR__ . '/../model/habitats.php');
require_once(__DIR__ . '/../lib/functions.php');

function addHabitatComment()
{
    if (isset($_POST['habitatComment']) && !empty($_POST['habitatComment'])) {
        $id = $_POST['habitatId'];
        $comment = nl2br(htmlspecialchars($_POST['habitatComment']));
        if (!ctype_space($comment)) {
            $habitatRepository = new HabitatsRepository;
            $success = $habitatRepository->addComment($comment, $id);
            setcookie(
                'ADD_HABITAT_COMMENT_SUCCESS',
                $success,
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        } else {
            setcookie(
                'ADD_HABITAT_COMMENT_ERROR',
                'Tous les champs ne sont pas remplis.',
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        }
    } else {
        setcookie(
            'ADD_HABITAT_COMMENT_ERROR',
            'Tous les champs ne sont pas remplis.',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
    }
    $url = $_SERVER['HTTP_REFERER'];
    redirectToUrl($url);
}
