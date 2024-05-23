<?php
$title = 'Services';
ob_start();
?>

<main>
    <h1 class="page-title"> Services </h1>

    <?php if (isset($_SESSION['LOGGED_USER']) && ($_SESSION['ROLE_USER'] === 3 || $_SESSION['ROLE_USER'] === 1)) : ?>

        <div class="create-service-form-container">
            <?php require('crudForm/createServiceForm.php'); ?>
        </div>


        <div class="alert-container">
            <!-- Update service -->
            <?php if (isset($_COOKIE['SERVICE_SUCCESS']) && $_COOKIE['SERVICE_SUCCESS'] === true) : ?>
                <div class="alert alert-success" role="alert">
                    Les modifications ont bien été effectué.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php elseif (isset($_COOKIE['SERVICE_ERROR'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_COOKIE['SERVICE_ERROR']; ?>
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
            <!-- Create service -->
            <?php if (isset($_COOKIE['CREATE_SERVICE_SUCCESS']) && $_COOKIE['CREATE_SERVICE_SUCCESS'] === true) : ?>
                <div class="alert alert-success" role="alert">
                    Les modifications ont bien été effectué.
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php elseif (isset($_COOKIE['CREATE_SERVICE_ERROR'])) : ?>
                <script>
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
                    <input type="text" name="serviceTitle" id="service-title" class="service-title" value="<?php echo $service['title'] ?>">
                </h4>

                <div class="service-content">
                    <p class="service-info-container">
                        <label for="service-description">Description</label>
                        <textarea class="service-description" name="serviceDescription" id="service-description" cols="30" rows="10" maxlength="255"><?php echo $service['description'] ?></textarea>
                    </p>
                    <div class="service-info-container">
                        <!-- "data:image/jpg;base64,.." convert base64 to jpg -->
                        <img class="service-img" src="data:image/jpg;base64,<?php echo $service['image'] ?>" alt="">
                        <input type="file" name="serviceImage" id="service-form-img" accept="image/png, image/jpeg">

                        <p class="service-info-container">
                            <label for="service-desc-add">Description additionnel (facultatif)</label>
                            <input type="text" name="serviceDescAdd" id="service-desc-add" class="service-description-additional" value="<?php echo $service['description_additional'] ?>">
                        </p>
                    </div>
                </div>

                <div class="service-form-button">
                    <button type="submit" name="editServiceId" value="<?php echo $service['id'] ?>" formaction="index.php?action=editService">Enregister les modifications</button>
                    <button type="submit" name="deleteServiceId" value="<?php echo $service['id'] ?>" formaction="index.php?action=deleteService">Supprimer ce service</button>
                </div>

            </form>

        <?php endforeach ?>

        <div class="button-container">
            <button type="button" class="button-crud">Ajouter un service</button>
        </div>

        <script src="script/addServiceScript.js"></script>

    <?php else : ?>

        <?php foreach ($services as $service) : ?>
            <article class="service">
                <h4 class="service-title"><?php echo nl2br(htmlspecialchars($service['title'])); ?></h4>
                <div class="service-content">
                    <p class="service-description"> <?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
                    <div>
                        <!-- "data:image/jpg;base64,.." convert base64 to jpg -->
                        <img class="service-img" src="data:image/jpg;base64,<?php echo $service['image'] ?>" alt="">
                        <p class="service-description-additional"> <?php echo nl2br(htmlspecialchars($service['description_additional'])); ?> </p>
                    </div>
                </div>
            </article>

        <?php endforeach ?>

    <?php endif ?>

</main>

<?php
$content = ob_get_clean();
require('templates/layout.php');
?>