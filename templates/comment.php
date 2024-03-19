<?php
//Récupérer les variables venant de la base de donnée
require_once(__DIR__ . '/variable.php');

for ($i = 0; $i < count($opinions); $i++) {
    $pseudo = $opinions[$i]['pseudo'];
    $date = $opinions[$i]['date'];
    $comment = $opinions[$i]['commentary'];

    echo "<article class='opinion'>
        <h6 class='pseudo'>$pseudo</h6>
        <p class='date'> publié le $date</p>
        <p class='comment'>$comment</p>
        </article>";
}
