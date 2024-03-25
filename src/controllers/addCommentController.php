<?php

require_once('src/model/comment.php');

function addComment(array $input)
{
    $pseudo = $input['pseudo'];
    $comment = $input['comment'];

    //check if the input are not only space
    if (ctype_space($pseudo) || ctype_space($comment)) {
        throw new Exception('L\'avis est invalides');
    } else {
        $commentRepository = new CommentRepository;
        $comment = $commentRepository->createComment($pseudo, $comment);

        if (!$comment) {
            throw new Exception('Impossible d\'ajouter l\'avis');
        } else {
            header('Location: index.php?action=homepage');
        }
    }
}
