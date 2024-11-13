<script>
    document.title = 'Modification d\'un animal';
</script>
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
        <input type="text" class="input-form" name="updateAnimalName" id="update-animal-name" value="<?php echo $animal['name']; ?>" maxlength="50" required>
    </div>
    <div class="input-container">
        <label for="animal-choose-race" class="label-input-form">Race</label>
        <select name="updateAnimalRace" id="animal-choose-race" class="input-form" required>
            <option value="" disabled></option>
            <?php foreach ($raceList as $race) : ?>
                <?php if ($race['label'] === $animal['race']) : ?>
                    <option value="<?php echo $race['id'] ?>" selected><?php echo $race['label'] ?></option>
                <?php else: ?>
                    <option value="<?php echo $race['id'] ?>"><?php echo $race['label'] ?></option>
                <?php endif ?>
            <?php endforeach ?>
        </select>
        <input type="text" name="updateAnimalAddRace" id="animal-add-race" class="input-form" required hidden disabled>
        <button type="button" id="btn-add-race">Ajouter une race</button>
    </div>
    <div class="input-container">
        <label for="update-animal-habitat" class="label-input-form">Habitat</label>
        <select name="updateAnimalHabitat" id="update-animal-habitat" class="input-form" required>
            <option value="" disabled></option>
            <?php foreach ($habitatList as $hab) : ?>
                <?php if ($hab['nom'] === $animal['habitat']) : ?>
                    <option value="<?php echo $hab['id'] ?>" selected><?php echo $hab['nom'] ?></option>
                <?php else: ?>
                    <option value="<?php echo $hab['id'] ?>"><?php echo $hab['nom'] ?></option>
                <?php endif ?>
            <?php endforeach ?>
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
<script src="script/changingInputRaceScript.js"></script>