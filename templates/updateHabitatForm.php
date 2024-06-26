<?php
$title = 'Modification de l\'habitat';
ob_start();
?>
<main>
    <h1 class="page-title">Modification d'un habitat</h1>

    <div class="alert-container">
        <?php if (isset($_COOKIE['UPDATE_HABITAT_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['UPDATE_HABITAT_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>

    <form action="index.php?action=updateHabitat" method="post" enctype="multipart/form-data">
        <section class="input-container">
            <label for="update-habitat-name" class="label-input-form">Nom</label>
            <input type="text" class="input-form" name="updateHabitatName" id="update-habitat-name" value="<?php echo $habitat['nom']; ?>" maxlength="50" required>
        </section>
        <section class="input-container-image">
            <div class="input-container">
                <label for="update-habitat-description" class="label-input-form">Description</label>
                <textarea class="input-form" name="updateHabitatDescription" id="update-habitat-description" cols="30" rows="10" maxlength="500" required>
                <?php echo $habitat['description']; ?>
            </textarea>
            </div>
            <div class="input-container">
                <label for="habitat-form-img" class="label-input-form">Image</label>
                <input type="file" class="input-image" name="updateHabitatImage" id="service-form-img" accept="image/png, image/jpeg">
            </div>
        </section>
        <input type="text" name="updateHabitatId" value="<?php echo $habitat['id']; ?>" hidden>
        <button type="submit">Confirmer</button>
    </form>
</main>
<?php
$content = ob_get_clean();
require('layout.php');
?>