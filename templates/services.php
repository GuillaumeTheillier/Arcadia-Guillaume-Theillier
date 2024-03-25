<?php
$title = 'Services';
ob_start();
?>
<main>
    <h1 class="page-title"> Services </h1>

    <article class="service">
        <h4 class="service-title">Restauration</h4>
        <div class="service-content">
            <p class="service-description">
                Au sein du zoo, vous retrouverez des zones de restauration mises
                à votre disposition.

                Des stands sont présents à plusieurs endroits dans le zoo.
                Vous pouvez acheter de la nourriture et des boissons.
                Ces stands sont ouverts toute la journée.
            </p>
            <div>
                <img class="service-img" src="/src/model/images/services/restaurant.jpg" alt="Salle du restaurant du zoo">
                <p class="service-description-additional">
                    Ouvert de 9h à 17h
                    Service déjeuner de 11h30 à 15h
                </p>
            </div>
        </div>
        <!--<img src="model\images\services\boissons-froides.jpg" alt="trois boissons froides posés sur une table">
        <img src="model\images\services\menu.jpg" alt="trois burgers, une bière et des frites posés sur une table.">
        <p>
            Notre restaurant propose des plats variés pour adulte et enfant.
            Possibilité de prendre des boissons chaudes et fraîches sur tout au long
            de la journée.
        </p>*/-->
    </article>

    <article class="service">
        <h4 class="service-title">Visite guidée (gratuit)</h4>
        <div class="service-content">
            <p class="service-description">
                Lors de votre passage au zoo, vous avez la possibilité de visiter le zoo
                avec l'un de nos guides gratuitement.
            </p>
            <div>
                <img class="service-img" src="/src/model\images\services\visite-guidee.jpg" alt="Salle du restaurant du zoo">
                <p class="service-description-additional"></p>
            </div>
        </div>
    </article>

    <article class="service">
        <h4 class="service-title">Visite en petit train</h4>
        <div class="service-content">
            <p class="service-description">
                Visiter le zoo Arcadia en petit train. Un guide vous fera le tour du zoo
                tout en vous commentant ce que vous observez.
            </p>
            <div>
                <img class="service-img" src="/src/model\images\services\petit-train.jpg" alt="Salle du restaurant du zoo">
                <p class="service-description-additional"></p>
            </div>
        </div>
    </article>
</main>

<?php
$content = ob_get_clean();
require('templates/layout.php');
?>