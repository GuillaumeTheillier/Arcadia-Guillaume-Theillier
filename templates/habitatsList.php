<?php
$title = 'Habitats';
ob_start();
?>
<main>
    <h1 class="page-title">Nos habitats</h1>

    <?php if (isset($_SESSION['LOGGED_USER']) && $_SESSION['ROLE_USER'] === 3) : ?>
        <!-- Display habitat for admin and employee -->

        <!--require frame for the form of habitat creation -->
        <?php require('crudForm/createHabitatForm.php'); ?>

        <!-- Create habitat button -->
        <div class="button-container">
            <button type="button" class="button-crud btn-open-frame">Ajouter un habitat</button>
        </div>

        <!-- Alert -->
        <div class="alert-container">
            <!--Create habitat alert-->
            <?php if (isset($_COOKIE['CREATE_HABITAT_SUCCESS']) && $_COOKIE['CREATE_HABITAT_SUCCESS'] == true) : ?>
                <div class="alert alert-success" role="alert">
                    L'habitat a bien été créé.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php elseif (isset($_COOKIE['CREATE_HABITAT_ERROR'])) : ?>
                <script>
                    document.querySelector('.crud-frame').classList.add('visible');
                    document.querySelector('body').style.overflow = 'hidden';
                </script>
            <?php endif; ?>
            <!--Delete habitat alert-->
            <?php if (isset($_COOKIE['DELETE_HABITAT_SUCCESS']) && $_COOKIE['DELETE_HABITAT_SUCCESS'] == true) : ?>
                <div class="alert alert-success" role="alert">
                    L'habitat a bien été supprimé.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php elseif (isset($_COOKIE['DELETE_HABITAT_ERROR'])) : ?>
                <div class="alert alert-danger" role="alert">
                    Une erreur est survenue lors de la suppression de l'habitat.
                    Réessayez plus tard.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
            <!--Update habitat alert-->
            <?php if (isset($_COOKIE['UPDATE_HABITAT_SUCCESS']) && $_COOKIE['UPDATE_HABITAT_SUCCESS'] == true) : ?>
                <div class="alert alert-success" role="alert">
                    Les informations sur l'habitat ont bien été modifiées.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
        </div>

        <div class="habitats-container">
            <?php foreach ($habitats as $habitat) : ?>
                <article>
                    <a href="index.php?action=habitat&habitat=<?php echo $habitat['id'] ?>" class="habitat">
                        <img class="habitat-img" src="data:image/jpg;base64,<?php echo $habitat['image'] ?>" alt="">
                        <h4 class="habitat-label"><?php echo $habitat['nom'] ?></h4>
                    </a>
                    <form method="post" class="button-container">
                        <button type="submit" class="button-crud" formaction="index.php?action=updateHabitatForm&habitat=<?php echo $habitat['id'] ?>">Modifier</button>
                        <button type="submit" name="habitatId" value="<?php echo $habitat['id'] ?>" class="button-crud" formaction="index.php?action=deleteHabitat">Supprimer</button>
                    </form>
                </article>
            <?php endforeach; ?>
        </div>
        <!-- This script useful only for the zoo's staff -->
        <script src="script\frameScript.js"></script>
    <?php else : ?>
        <!-- Display habitat for visitor -->
        <div class="habitats-container">
            <?php foreach ($habitats as $habitat) : ?>
                <a href="index.php?action=habitat&habitat=<?php echo $habitat['id'] ?>" class="habitat">
                    <img class="habitat-img" src="data:image/jpg;base64,<?php echo $habitat['image'] ?>" alt="">
                    <h4 class="habitat-label"><?php echo $habitat['nom'] ?></h4>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
</main>

<?php
$content = ob_get_clean();
require('index.php');
