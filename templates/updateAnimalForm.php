<?php
$title = 'Modification d\'un animal';
ob_start();
?>
<main>
    <h1 class="page-title">Modification d'un animal</h1>

    <div class="alert-container">
        <?php if (isset($_COOKIE['UPDATE_ANIMAL_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['UPDATE_ANIMAL_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>

    <form action="index.php?action=updateAnimal" method="post" enctype="multipart/form-data">
        <div class="input-container">
            <label for="update-animal-name" class="label-input-form">Nom</label>
            <input type="text" class="input-form" name="updateAnimalName" id="update-animal-name" value="<?php echo $animal['nom']; ?>" maxlength="50" required>
        </div>
        <div class="input-container">
            <label for="update-animal-race" class="label-input-form">Race</label>
            <select name="role" id="update-animal-race" class="input-form" required>
                <option value="1">Tapir du Brésil</option>
                <option value="2">Tigre d'indochine</option>
                <option value="3">Jaguar</option>
            </select>
        </div>
        <div class="input-container">
            <label for="update-animal-habitat" class="label-input-form">Rôle</label>
            <select name="role" id="update-animal-habitat" class="input-form" required>
                <option value="1">Jungle</option>
                <option value="2">Marais</option>
                <option value="3">Savane</option>
            </select>
        </div>
        <div class="input-container-image">
            <div class="input-container">
                <label for="animal-form-img" class="label-input-form">Image</label>
                <input type="file" class="input-image" name="updateAnimalImage" id="animal-form-img" accept="image/png, image/jpeg">
            </div>
        </div>
        <input type="text" name="updateAnimalId" value="<?php echo $animal['id']; ?>" hidden>
        <button type="submit">Confirmer</button>
    </form>
</main>
<?php
$content = ob_get_clean();
require('layout.php');
?>