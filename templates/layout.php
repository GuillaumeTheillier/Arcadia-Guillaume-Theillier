<?php //session_start(); 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <?php require_once(__DIR__ . '/head.php'); ?>
    <title> <?php echo 'Arcadia | ' . $title; ?> </title>
</head>

<body id="body">
    <?php require_once(__DIR__ . '/header.php'); ?>

    <?php echo $content; ?>

    <?php require_once(__DIR__ . '/footer.php'); ?>
</body>

</html>