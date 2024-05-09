<?php

require_once('src/model/comment.php');
require_once('src/lib/functions.php');

function manageComment()
{
    $commentRepository = new CommentRepository;
    $allcomment = $commentRepository->getAll();

    require('templates/manageComment.php');
}

function editVisibleComment()
{
    $isVisible = $_POST['visible'];
    $id = $_POST['commentId'];

    $commentRepository = new CommentRepository;
    $commentRepository->validComment($isVisible, $id);

    redirectToUrl('index.php?action=manageComment#' . $id);
}
