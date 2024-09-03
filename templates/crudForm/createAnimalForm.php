<div class="create-form-container">
    <div class="crud-frame" id="create-animal-frame">
        <button type='button' class="btn-close" id="btn-close-add-animal"></button>

        <h4 class="crud-frame-title">Ajout d'un animal</h4>

        <div class="alert-container">
            <?php if (isset($_COOKIE['CREATE_ANIMAL_ERROR'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_COOKIE['CREATE_ANIMAL_ERROR']; ?>
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
        </div>

        <form action="index.php?action=createAnimal" method="post">
            <div class="input-container">
                <label for="create-animal-name" class="label-input-form">Prénom</label>
                <input type="text" class="input-form" name="animalName" id="create-animal-name" required>
            </div>
            <div class="input-container">
                <label for="create-animal-race" class="label-input-form">Race</label>
                <select name="role" id="create-animal-race" class="input-form" required>
                    <option value="1">Tapir du Brésil</option>
                    <option value="2">Tigre d'indochine</option>
                    <option value="3">Jaguar</option>
                </select>
            </div>
            <div class="input-container">
                <label for="create-animal-habitat" class="label-input-form">Rôle</label>
                <select name="role" id="create-animal-habitat" class="input-form" required>
                    <option value="1">Jungle</option>
                    <option value="2">Marais</option>
                    <option value="3">Savane</option>
                </select>
            </div>
            <div class="input-container">
                <label for="habitat-form-img" class="label-input-form">Image</label>
                <input type="file" name="createAnimalImage" id="service-form-img" accept="image/png, image/jpeg" required>
            </div>
            <button type="submit">Confirmer</button>
        </form>
    </div>
</div>