<?php
$titre = 'nom animal';
ob_start();
?>

<main>
    <h1 class="page-title">Prenom</h1>
    <img src="" alt="">
    <div>
        <p>habitat : Marais</p>
        <p>Race : Tigre du méandre</p>
        <p>Etat de l'animal : En bonne santé.</p>
    </div>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>