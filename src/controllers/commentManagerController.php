<?php

require_once(__DIR__ . '/../model/comment.php');
require_once(__DIR__ . '/../lib/functions.php');

function commentManager()
{
    $commentRepository = new CommentRepository;
    $allcomment = $commentRepository->getAll();

    require('templates/commentManager.php');
}

function editVisibleComment()
{
    $isVisible = $_POST['visible'];
    $id = $_POST['commentId'];

    $commentRepository = new CommentRepository;
    $commentRepository->validComment($isVisible, $id);

    redirectToUrl('index.php?action=commentManager#' . $id);
}
