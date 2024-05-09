<?php
$title = $habitat['nom'];
ob_start();
?>

<main class="habitat">

    <h1 class="page-title">
        Habitat : <?php echo $habitat['nom'] ?>
    </h1>

    <?php if (isset($_SESSION['LOGGED_USER']) && $_SESSION['ROLE_USER'] === 3) : ?>

        <p class="habitat-description"> <?php echo $habitat['description'] ?> </p>

        <div class="button-container">
            <button type="button" class="button-crud">Ajouter un animal</button>
        </div>

        <div class="habitat-animals-list">
            <?php foreach ($animals as $animal) : ?>
                <article class="habitat-animal">
                    <a href="index.php?action=animal&animalName=<?php echo $animal['name'] ?>">
                        <img class="habitat-animal-img" src="data:img/jpg;base64,<?php echo $animal['image'] ?>" alt="">
                        <p class="habitat-animal-name"> <?php echo $animal['name'] ?> </p>
                        <p class="habitat-animal-race"> <?php echo $animal['race'] ?> </p>
                    </a>
                    <form method="post" class="button-container">
                        <button type="button" name="animalName" value="<?php echo $habitat['nom'] ?>" class="button-crud">Modifier</button>
                        <button type="submit" name="animalName" value="<?php echo $habitat['nom'] ?>" formaction="index.php?action=deleteAnimal" class="button-crud">Supprimer</button>
                    </form>
                </article>
            <?php endforeach ?>
        </div>

        <div class="button-container">
            <button type="button" class="button-crud">Ajouter un animal</button>
        </div>

    <?php else : ?>

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

    <?php endif ?>

</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>