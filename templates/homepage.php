<script>
    document.title = 'Accueil'
</script>
<!-- Carousel -->
<div id="carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../src\model\images\carousel\lions-1660044_1280.jpg" class="carousel-img" alt="Deux lions allongé">
        </div>
        <div class="carousel-item">
            <img src="..\src\model\images\carousel\animal-2475743_1280.jpg" class="carousel-img" alt="Un bébé gorille qui pose sa main sur une vitre">
        </div>
        <div class="carousel-item">
            <img src="..\src\model\images\carousel\pexels-nilina-584186.jpg" class="carousel-img" alt="Deux éléphants l'un en face de l'autre">
        </div>
        <div class="carousel-item">
            <img src="..\src\model\images\carousel\tigre-allonge-parquet.jpg" class="carousel-img" alt="Un tigre allongé">
        </div>
    </div>
</div>
<?php __DIR__ . '../src\model\images\carousel\lions-1660044_1280.jpg' ?>
<?php echo (__DIR__ . '/../src\model\images\carousel'); ?>
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
    <img src="../src/model\images\homepage\pexels-ricky-esquivel-1868861.jpg" alt="Un soigneur tenant un bébé crocodile dans ses mains">
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
            <img class="habitat-img" src="data:image/jpg;base64,<?php echo $habitat[2]['image'] ?>" alt="">
            <h5>Savane</h5>
        </div>
        <div class="hp-marais">
            <img class="habitat-img" src="data:image/jpg;base64,<?php echo $habitat[1]['image'] ?>" alt="">
            <h5>Marais</h5>
        </div>
        <div class="hp-jungle">
            <img class="habitat-img" src="data:image/jpg;base64,<?php echo $habitat[0]['image'] ?>" alt="">
            <h5>Jungle</h5>
        </div>
    </div>
</article>

<!-- second part of the zoo presentation -->
<article class="homepage-presentation">
    <img src="../src/model\images\homepage\plan-vertical-foret-soignes-soleil-qui-brille-travers-branches.jpg" alt="Un soigneur tenant un bébé crocodile dans ses mains">
    <p>
        Nous sommes situés en Bretagne près de la forêt de Brocéliande, terre de mythe et
        de légende. Vous serez accueillie par nos guides pour une visites du parc.
        A votre disposition, des zones de restauration sont disponibles à plusieurs
        endroits du zoo.
    </p>
</article>

<!-- Comment -->
<section class="comment-section" id="comments">

    <h3>Avis</h3>

    <?php if (isset($_COOKIE['COMMENT_SUCCESS'])) : ?>
        <div class="alert alert-success" role="alert">
            Votre avis a bien été pris en compte. Il sera vérifier avant d'être afficher.
            <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
        </div>
    <?php elseif (isset($_COOKIE['COMMENT_ERROR'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_COOKIE['COMMENT_ERROR']; ?>
            <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
        </div>
    <?php endif; ?>

    <form action="index.php?action=addComment" method="post" class="form-comment">
        <input type="text" class="input-form" name="pseudo" id="pseudo" placeholder="Entrer votre pseudo" min="5" maxlength="20" required>
        <textarea class="input-form" name="comment" id="comment" cols="40" rows="5" maxlength="255" placeholder="Ecriver votre commentaire" required></textarea>
        <button type="submit">Envoyer</button>
    </form>

    <article class="comments-lists">
        <!-- All visitor's comment -->
        <?php foreach ($comments as $comment) : ?>
            <article class="comment-container">
                <p class="pseudo"><?php echo htmlspecialchars($comment['pseudo']); ?></p>
                <p class="date">publié le <?php echo $comment['date']; ?></p>
                <p class="comment"><?php echo nl2br(htmlspecialchars($comment['commentaire'])); ?></p>
            </article>
        <?php endforeach; ?>
    </article>
</section>