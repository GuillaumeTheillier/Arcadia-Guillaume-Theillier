<div class="create-form-container">
    <div class="crud-frame">
        <button type='button' class="btn-close btn-close-frame"></button>

        <h4 class="crud-frame-title">Ajout d'un animal</h4>

        <!-- Create error -->
        <div class="alert-container">
            <?php if (isset($_COOKIE['CREATE_ANIMAL_ERROR'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_COOKIE['CREATE_ANIMAL_ERROR']; ?>
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
        </div>

        <form action="index.php?action=createAnimal" method="post" enctype="multipart/form-data">
            <div class="input-container">
                <label for="create-animal-name" class="label-input-form">Prénom</label>
                <input type="text" name="createAnimalName" class="input-form" id="create-animal-name" required>
            </div>
            <div class="input-container">
                <label for="animal-choose-race" class="label-input-form">Race</label>
                <select name="createAnimalRace" id="animal-choose-race" class="input-form" required>
                    <option value=""></option>
                    <?php foreach ($raceList as $race) : ?>
                        <option value="<?php echo $race['id'] ?>"><?php echo $race['label'] ?></option>
                    <?php endforeach ?>
                </select>
                <input type="text" name="createAnimalAddRace" id="animal-add-race" class="input-form" required hidden disabled>
                <button type="button" id="btn-add-race">Ajouter une race</button>
            </div>
            <div class="input-container">
                <label for="create-animal-habitat" class="label-input-form">Habitat</label>
                <select name="createAnimalHabitat" id="create-animal-habitat" class="input-form" required>
                    <option value=""></option>
                    <?php foreach ($habitatList as $hab) : ?>
                        <option value="<?php echo $hab['id'] ?>"><?php echo $hab['nom'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="input-container">
                <label for="create-animal-form-img" class="label-input-form">Image</label>
                <input type="file" name="createAnimalImage" id="create-animal-form-img" accept="image/png, image/jpeg" required>
            </div>
            <button type="submit">Confirmer</button>
        </form>
    </div>
    <script src="script/changingInputRaceScript.js"></script>
</div>