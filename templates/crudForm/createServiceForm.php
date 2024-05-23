<div class="crud-frame" id="create-service-frame">
    <button type='button' class="btn-close" id="btn-close-add-service"></button>

    <h4 class="crud-frame-title">Créer un service</h4>

    <div class="alert-container">
        <?php if (isset($_COOKIE['CREATE_SERVICE_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['CREATE_SERVICE_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>

    <form action="index.php?action=createService" method="post">
        <section class="input-container">
            <label for="service-title" class="label-input-form">Titre</label>
            <input type="text" name="serviceTitle" id="service-title" class="input-form">
        </section>
        <section class="input-container">
            <label for="service-description" class="label-input-form">Description</label>
            <textarea class="input-form" name="serviceDescription" id="service-description" cols="30" rows="10" maxlength="255"></textarea>
        </section>
        <section class="input-container">
            <label for="service-form-img" class="label-input-form">Image</label>
            <div class="service-add-img-container">
                <img src="src\model\images\services\boissons-froides.jpg" alt="previsuel de l'image" class="img-form-add">
                <input type="file" name="serviceImage" id="service-form-img" accept="image/png, image/jpeg">
            </div>
        </section>
        <section class="input-container">
            <label for="service-desc-add" class="label-input-form">Description additionnel (facultatif)</label>
            <textarea class="input-form" name="serviceDescAdd" id="service-desc-add" cols="30" rows="3" maxlength="255"></textarea>
        </section>
        <button type="submit">Confirmer</button>
    </form>
</div>