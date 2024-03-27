<?php
$title = 'Habitats';
ob_start();
?>
<main>
    <h1 class="page-title">Nos habitats</h1>

    <div class="habitats-container">

        <?php foreach ($habitats as $habitat) : ?>
            <div class="habitat">
                <img class="habitat-img" src="data:image/jpg;base64,<?php echo $habitat['image'] ?>" alt="">
                <h4 class="habitat-label"><?php echo $habitat['nom'] ?></h4>
            </div>
        <?php endforeach; ?>

    </div>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
