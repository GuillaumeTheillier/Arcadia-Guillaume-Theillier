<?php
$title = 'Habitats';
ob_start();
?>
<main>
    <h1 class="page-title">Nos habitats</h1>

    <?php if (isset($_SESSION['LOGGED_USER']) && $_SESSION['ROLE_USER'] === 3) : ?>
        <!-- Display habitat for admin and employee -->
        <div class="create-form-container">
            <?php require('crudForm/createHabitatForm.php'); ?>
        </div>

        <!-- Alert -->
        <?php if (isset($_COOKIE['CREATE_HABITAT_SUCCESS']) && $_COOKIE['CREATE_HABITAT_SUCCESS'] == true) : ?>
            <div class="alert alert-success" role="alert">
                l'habitat a bient été créé.
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php elseif (isset($_COOKIE['CREATE_HABITAT_ERROR'])) : ?>
            <script>
                createHabitatFrame.style.display = 'block';
            </script>
        <?php endif; ?>
        <div class="button-container">
            <button type="button" class="button-crud" id="btn-open-add-habitat">Ajouter un habitat</button>
        </div>

        <div class="habitats-container">
            <?php foreach ($habitats as $habitat) : ?>
                <article>
                    <a href="index.php?action=habitat&habitatName=<?php echo $habitat['nom'] ?>" class="habitat">
                        <img class="habitat-img" src="data:image/jpg;base64,<?php echo $habitat['image'] ?>" alt="">
                        <h4 class="habitat-label"><?php echo $habitat['nom'] ?></h4>
                    </a>
                    <form method="post" class="button-container">
                        <button type="submit" name="habitatName" value="<?php echo $habitat['nom'] ?>" formaction="index.php?action=updateHabitatForm" class="button-crud">Modifier</button>
                        <button type="submit" name="habitatName" value="<?php echo $habitat['nom'] ?>" formaction="index.php?action=deleteHabitat" class="button-crud">Supprimer</button>
                    </form>
                </article>
            <?php endforeach; ?>
        </div>
        <script src="script/addHabitatScript.js"></script>
    <?php else : ?>
        <!-- Display habitat for visitor -->
        <div class="habitats-container">
            <?php foreach ($habitats as $habitat) : ?>
                <a href="index.php?action=habitat&habitatName=<?php echo $habitat['nom'] ?>" class="habitat">
                    <img class="habitat-img" src="data:image/jpg;base64,<?php echo $habitat['image'] ?>" alt="">
                    <h4 class="habitat-label"><?php echo $habitat['nom'] ?></h4>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
