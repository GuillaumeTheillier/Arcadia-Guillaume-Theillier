<?php
$title = 'Services';
ob_start();
?>

<main>
    <h1 class="page-title"> Services </h1>

    <?php if (isset($_SESSION['LOGGED_USER']) && $_SESSION['ROLE_USER'] === 3) : ?>

        <button type="button" class="service-add-button">Ajouter un service</button>

        <?php foreach ($services as $service) : ?>
            <form method="post" class="service-form" enctype='multipart/form-data'>

                <h4 class="service-info-container">
                    <label for="service-title">Titre</label>
                    <input type="text" name="serviceTitle" id="service-title" class="service-title" value="<?php echo $service['title'] ?>">
                </h4>

                <div class="service-content">
                    <p class="service-info-container">
                        <label for="service-description">description</label>
                        <textarea class="service-description" name="serviceDescription" id="service-description" cols="30" rows="10" maxlength="255"><?php echo $service['description'] ?></textarea>
                    </p>
                    <div>
                        <!-- "data:image/jpg;base64,.." convert base64 to jpg -->
                        <img class="service-img" src="data:image/jpg;base64,<?php echo $service['image'] ?>" alt="">
                        <input type="file" name="serviceImage" id="service-image" accept="image/png, image/jpeg">

                        <p class="service-info-container">
                            <label for="service-desc-add">description additionnel (facultatif)</label>
                            <input type="text" name="serviceDescAdd" id="service-desc-add" class="service-description-additional" value="<?php echo $service['description_additional'] ?>">
                        </p>
                    </div>
                </div>

                <button type="submit" name="editServiceId" formaction="index.php?action=editService">Enregister les modifications</button>
                <button type="submit" name="deleteServiceId" value="<?php echo $service['id'] ?>" formaction="index.php?action=deleteService">Supprimer ce service</button>

            </form>

        <?php endforeach ?>
        <button type="submit" class="service-add-button">Ajouter un service</button>

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