<?php
$title = $habitat['nom'];
ob_start();
?>

<main class="habitat">

    <h1 class="page-title">
        Habitat : <?php echo $habitat['nom'] ?>
    </h1>

    <p class="habitat-description"> <?php echo $habitat['description'] ?> </p>

    <div class="habitat-animals-list">
        <?php foreach ($animals as $animal) : ?>
            <a class="habitat-animal" href="index.php?action=animal&animalName=<?php echo $animal['name'] ?>">
                <img class="habitat-animal-img" src="data:img/jpg;base64,<?php echo $animal['image'] ?>" alt="">
                <p class="habitat-animal-name"> <?php echo $animal['name'] ?> </p>
                <p class="habitat-animal-race"> <?php echo $animal['race'] ?> </p>
            </a>
        <?php endforeach ?>
    </div>

</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>