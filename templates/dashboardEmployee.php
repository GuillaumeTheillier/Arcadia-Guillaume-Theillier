<?php
$title = 'Tableau de bord';
ob_start();
?>

<main>
        <h1 class="page-title"> Tableau de bord </h1>

        <div class="dashboard-container">

        </div>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>