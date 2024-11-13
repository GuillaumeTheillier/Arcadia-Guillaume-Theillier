<?php session_start(); ?>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <?php require_once('templates/head.php'); ?>
    <title> <?php echo 'Arcadia'; ?> </title>
</head>

<body>
    <?php require_once('src/controllers/requireAllControllers.php'); ?>

    <header><?php require_once(__DIR__ . '/templates/header.php'); ?></header>
    <main>
        <?php
        if (isset($_GET['action']) && $_GET['action'] !== '') {
            //if there are an error return unfound page
            try {
                $action = $_GET['action'];
                if ($action === 'addComment') {
                    addComment($_POST);
                } elseif (isset($_GET['habitat']) && is_numeric($_GET['habitat'])) {
                    $habitatId = $_GET['habitat'];
                    $action($habitatId);
                } elseif (isset($_GET['animal']) && is_numeric($_GET['animal'])) {
                    $animalId = $_GET['animal'];
                    $action($animalId);
                } else {
                    $action();
                }
            } catch (Error $e) {
                pageNotFound();
            }
        } else {
            homepage();
        }
        ?>
    </main>
    <footer><?php require_once(__DIR__ . '/templates/footer.php'); ?></footer>
</body>

</html>