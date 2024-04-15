<?php
$title = 'Tableau de bord';
ob_start();
?>

<main>
    <h1 class="page-title"> Tableau de bord </h1>

    <section class="dashboard-container">

        <button>Créer un nouveau compte</button>
    </section>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>