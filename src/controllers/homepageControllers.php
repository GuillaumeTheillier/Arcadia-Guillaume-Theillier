<?php

require_once('src/model/comment.php');
//require_once('src/model/database.php');

function homepage()
{
    //Get visitor comments from database
    $commentRepository = new CommentRepository();
    $comments = $commentRepository->getComments();

    require('templates/homepage.php');
}
