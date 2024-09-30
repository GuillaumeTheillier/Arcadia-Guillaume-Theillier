<?php
require_once('src/model/habitats.php');

function habitatComment()
{
    $habitatRepository = new HabitatsRepository;
    $commentList = $habitatRepository->getAllComment();
    require_once('templates/habitatCommentList.php');
}
