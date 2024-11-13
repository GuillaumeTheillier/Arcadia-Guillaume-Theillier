<script>
    document.title = <?php echo $animal['name'] ?>;
</script>
<div class="animal-container">
    <h1 class="page-title"><?php echo $animal['name'] ?></h1>

    <div class="animal-flex">
        <img class="animal-img" src="data:image/jpg;base64,<?php echo $animal['image'] ?>" alt="">
        <div class="animal-description">
            <p class="animal-habitat">habitat : <?php echo $animal['habitat'] ?> </p>
            <p class="animal-race">Race : <?php echo $animal['race'] ?> </p>
            <p class="animal-status">Etat de l'animal : <?php echo $animal['status'] ?></p>
        </div>
    </div>
</div>