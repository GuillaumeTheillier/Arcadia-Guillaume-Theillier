<script>
    document.title = 'Infos pratiques';
</script>
<div class="infos">
    <h1 class="page-title">Infos pratiques</h1>

    <p class="infos-location">
        Notre zoo Arcadia se situe dans le département du Morbihan(56), à 1h à l'ouest de Rennes,
        à proximité de la forêt de Brocéliande.
    </p>

    <div class="infos-container">
        <div class="infos-schedule">
            <h3>Horaires</h3>
            <table>
                <?php
                $semaine = array(
                    " Lundi ",
                    " Mardi ",
                    " Mercredi ",
                    " Jeudi ",
                    " Vendredi ",
                    " Samedi ",
                    " Dimanche "
                );
                for ($i = 1; $i < count($schedule); $i++) :
                ?>
                    <tr>
                        <?php $dayEn = strtolower(date('l', 259200 + (86400 * $i))); ?>
                        <td class="infos-schedule-day"><?php echo $semaine[$i - 1] ?></td>
                        <td>
                            <?php echo $schedule[$dayEn]['ouverture'] . ' - ' . $schedule[$dayEn]['fermeture'] ?>
                        </td>
                    </tr>
                <?php endfor ?>
            </table>
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
</div>