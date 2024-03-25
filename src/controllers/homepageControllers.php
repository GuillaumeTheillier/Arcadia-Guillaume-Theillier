<?php

require_once('src/model/comment.php');

function homepage()
{
    //Get visitor comments from database
    $commentRepository = new CommentRepository;
    $comments = $commentRepository->getComments();

    require('templates/homepage.php');
}
