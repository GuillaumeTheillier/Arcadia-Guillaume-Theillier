<?php
$title = 'Page introuvable';
ob_start();
?>

<main>
    <div class="unfound-container">
        <p class="unfound-text">Page introuvable</p>
        <img class="unfound-img" src="src\model\images\undraw_not_found_re_bh2e.svg" alt="page introuvable">
    </div>
</main>

<?php
$content = ob_get_clean();
require('index.php');
?>