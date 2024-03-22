<?php $title = 'Accueil'; ?>

<?php ob_start(); ?>
<main>
    <!-- Carousel -->
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="model\images\carousel\lions-1660044_1280.jpg" class="carousel-img" alt="Deux lions allongé">
            </div>
            <div class="carousel-item">
                <img src="model\images\carousel\animal-2475743_1280.jpg" class="carousel-img" alt="Un bébé gorille qui pose sa main sur une vitre">
            </div>
            <div class="carousel-item">
                <img src="model\images\carousel\pexels-nilina-584186.jpg" class="carousel-img" alt="Deux éléphants l'un en face de l'autre">
            </div>
            <div class="carousel-item">
                <img src="model\images\carousel\tigre-allonge-parquet.jpg" class="carousel-img" alt="Un tigre allongé">
            </div>
        </div>
    </div>

    <!-- Welcome text -->
    <p class="welcome-text">
        Bienvenue au <br> zoo Arcadia
    </p>

    <!-- first part of the zoo presentation -->
    <article class="homepage-presentation">
        <p>
            Depuis 1960, Arcadia vous convie à partir en voyage avec toute la famille.
            Venez explorer une partie de la diversité biologique présente sur notre planète.
        </p>
        <img src="model\images\homepage\pexels-ricky-esquivel-1868861.jpg" alt="Un soigneur tenant un bébé crocodile dans ses mains">
    </article>

    <!-- show the zoo's three habitat  -->
    <article class="homepage-habitat">
        <h2>Des animaux fascinants !</h2>
        <p>
            Rejoignez-nous lors de cette visite à la rencontre de plus de 400
            animaux répartis dans nos 3 habitats.
        </p>
        <div class="hp-hab">
            <div class="hp-savane">
                <img src="model\images\homepage\suricate.jpg" alt="suricate">
                <h5>Savane</h5>
            </div>
            <div class="hp-marais">
                <img src="model\images\homepage\pexels-henning-roettger-2100047.jpg" alt="Crocodile">
                <h5>Marais</h5>
            </div>
            <div class="hp-jungle">
                <img src="model\images\homepage\zoo-4007318_1280.jpg" alt="léopard">
                <h5>Jungle</h5>
            </div>
        </div>
    </article>

    <!-- second part of the zoo presentation -->
    <article class="homepage-presentation">
        <img src="model\images\homepage\plan-vertical-foret-soignes-soleil-qui-brille-travers-branches.jpg" alt="Un soigneur tenant un bébé crocodile dans ses mains">
        <p>
            Nous sommes situés en Bretagne près de la forêt de Brocéliande, terre de mythe et
            de légende. Vous serez accueillie par nos guides pour une visites du parc.
            A votre disposition, des zones de restauration sont disponibles à plusieurs
            endroits du zoo.
        </p>
    </article>


    <!-- Opinion -->
    <article class="opinions">
        <form action="" method="post" class="form-opinion">
            <h3>Avis</h3>
            <input type="text" name="pseudo" id="pseudo" placeholder="Entrer votre pseudo" maxlength="15" required>
            <textarea name="comment" id="comment" cols="40" rows="5" maxlength="250" placeholder="Ecriver votre commentaire" required></textarea>
            <button type="button">Envoyer</button>
        </form>

        <article class="opinions-lists">
            <!-- All visitor's opinion -->
            <?php require_once(__DIR__ . '/comment.php'); ?>
        </article>
    </article>
</main>


<?php
//Get all content we have previous write with HTML
$content = ob_get_clean(); ?>

<?php
require(__DIR__ . '/layout.php')
?>