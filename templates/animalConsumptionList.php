<?php
$title = 'liste des consommations de nourriture de ?';
ob_start();
?>

<main class="animal-container">
    <h1 class="page-title"><?php echo $animal['name'] ?></h1>
    <?php require('crudForm/addAnimalReport.php'); ?>
    <div id="animal-flex">
        <img class="animal-img" src="data:image/jpg;base64,<?php echo $animal['image'] ?>" alt="">
        <div class="animal-description">
            <p class="animal-habitat">habitat : <?php echo $animal['habitat'] ?> </p>
            <p class="animal-race">Race : <?php echo $animal['race'] ?> </p>
            <p class="animal-status">Etat de l'animal : <?php echo $animal['status'] ?></p>
            <button type="button" class="button-crud btn-open-frame">Ajouter un compte rendu</button>
        </div>
    </div>
    <div class="animal-list-container">
        <table class="animal-list">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>type de nourriture</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consumptionList as $consumption) : ?>
                    <tr class="table-row">

                        <td><?php echo $consumption['date']; ?></td>
                        <td><?php echo $consumption['foodType']; ?></td>
                        <td><?php echo $consumption['quantity']; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <script src="script\frameScript.js"></script>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>