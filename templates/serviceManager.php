<?php
$title = 'Services';
ob_start();
?>

<main>
    <h1 class="page-title">Services</h1>

    <div class="create-form-container">
        <?php require('crudForm/createServiceForm.php'); ?>
    </div>

    <!-- Alert -->
    <div class="alert-container">
        <!-- Update service -->
        <?php if (isset($_COOKIE['UPDATE_SERVICE_SUCCESS']) && $_COOKIE['UPDATE_SERVICE_SUCCESS'] == true) : ?>
            <div class="alert alert-success" role="alert">
                Les modifications ont bien été effectué.
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php elseif (isset($_COOKIE['UPDATE_SERVICE_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['UPDATE_SERVICE_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
        <!-- Create service -->
        <?php if (isset($_COOKIE['CREATE_SERVICE_SUCCESS']) && $_COOKIE['CREATE_SERVICE_SUCCESS'] == true) : ?>
            <div class="alert alert-success" role="alert">
                Le service a été créé avec succès.
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php elseif (isset($_COOKIE['CREATE_SERVICE_ERROR'])) : ?>
            <script>
                //const createServiceFrame = document.getElementById('create-service-frame');
                createServiceFrame.style.display = 'block';
            </script>
        <?php endif; ?>
    </div>

    <div class="button-container">
        <button type="button" id="btn-open-add-service" class="button-crud">Ajouter un service</button>
    </div>

    <?php foreach ($services as $service) : ?>
        <form method="post" class="service-form" enctype='multipart/form-data'>

            <h4 class="service-info-container">
                <label for="service-title">Titre</label>
                <input type="text" name="updateServiceTitle" id="service-title" class="service-title" value="<?php echo $service['title'] ?>">
            </h4>

            <div class="service-content">
                <p class="service-info-container">
                    <label for="service-description">Description</label>
                    <textarea class="service-description" name="updateServiceDescription" id="service-description" cols="30" rows="10" maxlength="255"><?php echo $service['description'] ?></textarea>
                </p>
                <div class="service-info-container">
                    <!-- "data:image/jpg;base64,.." convert base64 to jpg -->
                    <img class="service-img" src="data:image/jpg;base64,<?php echo $service['image'] ?>" alt="">
                    <input type="file" name="updateServiceImage" id="service-form-img" accept="image/png, image/jpeg">

                    <p class="service-info-container">
                        <label for="service-desc-add">Description additionnel (facultatif)</label>
                        <input type="text" name="updateServiceDescAdd" id="service-desc-add" class="service-description-additional" value="<?php echo $service['description_additional'] ?>">
                    </p>
                </div>
            </div>

            <div class="service-form-button">
                <button type="submit" name="updateServiceId" value="<?php echo $service['id'] ?>" formaction="index.php?action=updateService">Enregister les modifications</button>
                <button type="submit" name="deleteServiceId" value="<?php echo $service['id'] ?>" formaction="index.php?action=deleteService">Supprimer ce service</button>
            </div>
        </form>
    <?php endforeach ?>

    <div class="button-container">
        <button type="button" class="button-crud">Ajouter un service</button>
    </div>

    <script src="script/addServiceScript.js"></script>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>