<?php

require_once(__DIR__ . '/../model/comment.php');

function addComment(array $input)
{
    $pseudo = $input['pseudo'];
    $comment = $input['comment'];

    //check if the input are not only space
    if (ctype_space($pseudo) || ctype_space($comment)) {
        setcookie(
            'COMMENT_ERROR',
            'Pseudo et/ou commentaire invalides',
            [
                'expires' => time() + 1,
                'httponly' => true,
                'secure' => true
            ]
        );
        //throw new Exception('L\'avis est invalides');
    } else {
        $commentRepository = new CommentRepository;
        $comment = $commentRepository->createComment($pseudo, $comment);

        if (!$comment) {
            setcookie(
                'COMMENT_ERROR',
                'Impossible d\'ajouter l\'avis.<br> Veuillez réessayer ultérieurement',
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
            //throw new Exception('Impossible d\'ajouter l\'avis');
        } else {

            setcookie(
                'COMMENT_SUCCESS',
                true,
                [
                    'expires' => time() + 1,
                    'httponly' => true,
                    'secure' => true
                ]
            );
        }
    }

    header('Location: index.php?action=homepage#comments');
}
