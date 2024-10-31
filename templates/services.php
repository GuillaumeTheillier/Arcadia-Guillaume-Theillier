<?php
$title = 'Services';
ob_start();
?>

<main>
    <h1 class="page-title"> Services </h1>

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
</main>

<?php
$content = ob_get_clean();
require('index.php');
?>