<?php
$title = $habitat['nom'];
ob_start();
?>

<main class="habitat">

    <h1 class="page-title">
        Habitat : <?php echo $habitat['nom']; ?>
    </h1>

    <!-- Staff page -->
    <?php if (isset($_SESSION['LOGGED_USER']) && $_SESSION['ROLE_USER'] === 3) : ?>
        <!--require frame for the form of animal creation -->
        <?php require('crudForm/createAnimalForm.php'); ?>

        <p class="habitat-description"> <?php echo $habitat['description'] ?> </p>
        <div class="habitat-comment">
            <h5>Commentaire sur l'habitat</h5>
            <p><?php echo $habitat['comment'] ?></p>
        </div>

        <div class="button-container">
            <button type="button" class="button-crud btn-open-frame">Ajouter un animal</button>
        </div>

        <!-- Alert -->
        <div class="alert-container">
            <!--Create animal alert-->
            <?php if (isset($_COOKIE['CREATE_ANIMAL_SUCCESS']) && $_COOKIE['CREATE_ANIMAL_SUCCESS'] == true) : ?>
                <div class="alert alert-success" role="alert">
                    L'animal a bien été créé.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php elseif (isset($_COOKIE['CREATE_ANIMAL_ERROR'])) : ?>
                <script>
                    document.querySelector('.crud-frame').classList.add('visible');
                    document.querySelector('body').style.overflow = 'hidden';
                </script>
            <?php endif; ?>
            <!--Delete animal alert-->
            <?php if (isset($_COOKIE['DELETE_ANIMAL_SUCCESS']) && $_COOKIE['DELETE_ANIMAL_SUCCESS'] == true) : ?>
                <div class="alert alert-success" role="alert">
                    L'animal a bien été supprimé.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php elseif (isset($_COOKIE['DELETE_ANIMAL_ERROR'])) : ?>
                <div class="alert alert-danger" role="alert">
                    Une erreur est survenue lors de la suppression de l'animal.
                    Veuillez réessayer.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
            <!--Update animal alert-->
            <?php if (isset($_COOKIE['UPDATE_ANIMAL_SUCCESS']) && $_COOKIE['UPDATE_ANIMAL_SUCCESS'] == true) : ?>
                <div class="alert alert-success" role="alert">
                    Les informations sur l'animal ont bien été modifiées.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
        </div>

        <div class="habitat-animals-list">
            <?php foreach ($animals as $animal) : ?>
                <article class="habitat-animal">
                    <a href="index.php?action=animal&animal=<?php echo $animal['id'] ?>">
                        <img class="habitat-animal-img" src="data:image/webp;base64,<?php echo $animal['image'] ?>" alt="">
                        <p class="habitat-animal-name"> <?php echo $animal['name'] ?> </p>
                        <p class="habitat-animal-race"> <?php echo $animal['race'] ?> </p>
                    </a>
                    <form method="post" class="button-container">
                        <button type="submit" name="animalId" value="<?php echo $animal['id'] ?>" class="button-crud" formaction="index.php?action=updateAnimalForm&animal=<?php echo $animal['id'] ?>">Modifier</button>
                        <button type="submit" name="animalId" value="<?php echo $animal['id'] ?>" class="button-crud" formaction="index.php?action=deleteAnimal">Supprimer</button>
                    </form>
                </article>
            <?php endforeach ?>
        </div>
        <!-- This script is only useful for the zoo's staff -->
        <script src="script\frameScript.js"></script>
    <?php else : ?>
        <!-- Visitor page -->
        <p class="habitat-description"> <?php echo $habitat['description'] ?> </p>

        <div class="habitat-animals-list">
            <?php foreach ($animals as $animal) : ?>
                <a class="habitat-animal" href="index.php?action=animal&animal=<?php echo $animal['id'] ?>">
                    <img class="habitat-animal-img" src="data:image/webp;base64,<?php echo $animal['image'] ?>" alt="">
                    <p class="habitat-animal-name"> <?php echo $animal['name'] ?> </p>
                    <p class="habitat-animal-race"> <?php echo $animal['race'] ?> </p>
                </a>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</main>

<?php
$content = ob_get_clean();
require('index.php');
?>