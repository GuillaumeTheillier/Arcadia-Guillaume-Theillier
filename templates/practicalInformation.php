<?php
$title = 'infos pratiques';
ob_start();
?>

<main class="infos">
    <h1 class="page-title">Infos pratiques</h1>

    <p class="infos-location">
        Notre zoo Arcadia se situe dans le département du Morbihan(56), à 1h à l'ouest de Rennes,
        à proximité de la forêt de Brocéliande.
    </p>

    <div class="infos-container">
        <div class="infos-opening-hours">
            <h3>Horaires</h3>
            <p>
                Lundi 09:00 - 19:00 <br>
                Mardi 09:00 - 19:00 <br>
                Mercredi 09:00 - 19:00 <br>
                Jeudi 09:00 - 19:00 <br>
                Vendredi 09:00 - 19:00 <br>
                Samedi 09:00 - 19:00 <br>
                Dimanche 09:00 - 19:00
            </p>
        </div>
        <div class="infos-container-separator"></div>
        <div class="infos-address">
            <h3>Adresse</h3>
            <p>14 Avenue du Compère <br> 54430 Concoret</p>
        </div>
    </div>

    <div class="infos-parking">
        <h3>Parking</h3>
        <p>
            Un parking gratuit est présent à côté de l'entrée du zooparc.
            Des emplacements pour les cars et camping-cars sont disponibles.
        </p>
    </div>
</main>

<?php
$content = ob_get_clean();
require(__DIR__ . '/layout.php');
?>