<?php
require_once(__DIR__ . '/../model/habitats.php');

function habitatComment()
{
    $habitatRepository = new HabitatsRepository;
    $commentList = $habitatRepository->getAllComment();
    require_once(__DIR__ . '/../../templates/habitatCommentList.php');
}
