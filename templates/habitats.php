<?php
$title = 'Habitats';
ob_start();
?>
<main>
    <h1 class="page-title">Nos habitats</h1>

    <div class="habitats-container">
        <div class="habitat">
            <img class="habitat-img" src="<?php echo $savaneImg ?>" alt="image d'un suricate">
            <h4 class="habitat-label">Savane</h4>
        </div>
        <div class="habitat">
            <img class="habitat-img" src="<?php echo $maraisImg ?>" alt="image d'un crocodile">
            <h4 class="habitat-label">Marais</h4>
        </div>
        <div class="habitat">
            <img class="habitat-img" src="<?php echo $jungleImg ?>" alt="image d'un léopard">
            <h4 class="habitat-label">Jungle</h4>
        </div>
    </div>
    </div>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
