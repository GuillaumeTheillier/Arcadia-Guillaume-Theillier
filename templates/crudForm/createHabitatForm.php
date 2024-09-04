<div class="create-form-container">
    <div class="crud-frame">
        <button type='button' class="btn-close btn-close-frame"></button>

        <h4 class="crud-frame-title">Créer un habitat</h4>

        <div class="alert-container">
            <?php if (isset($_COOKIE['CREATE_HABITAT_ERROR'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_COOKIE['CREATE_HABITAT_ERROR']; ?>
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
        </div>

        <form action="index.php?action=createHabitat" method="post" enctype="multipart/form-data">
            <section class="input-container">
                <label for="create-habitat-name" class="label-input-form">Nom</label>
                <input type="text" class="input-form" name="createHabitatName" id="create-habitat-name" maxlength="50" required>
            </section>
            <section class="input-container">
                <label for="create-habitat-description" class="label-input-form">Description</label>
                <input type="text" class="input-form" name="createHabitatDescription" id="create-habitat-description" maxlength="500" required>
            </section>
            <section class="input-container">
                <label for="habitat-form-img" class="label-input-form">Image</label>
                <input type="file" name="createHabitatImage" id="service-form-img" accept="image/png, image/jpeg" required>
            </section>
            <button type="submit">Confirmer</button>
        </form>
    </div>
</div>