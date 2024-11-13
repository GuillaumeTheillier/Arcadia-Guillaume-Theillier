<?php
require_once(__DIR__ . '/../model/comment.php');
require_once(__DIR__ . '/../model/habitats.php');

function homepage()
{
    // Get visitor comments from database
    $commentRepository = new CommentRepository;
    $comments = $commentRepository->getComments();
    // Get habitat image
    $habitatRepository = new HabitatsRepository;
    $habitat = $habitatRepository->getAllHabitats();
    require(__DIR__ . '/../../templates/homepage.php');
}
