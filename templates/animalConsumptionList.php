<?php
$title = 'liste des consommations de nourriture de ?';
ob_start();
?>

<main class="animal-container">
    <h1 class="page-title"><?php echo $animal['name'] ?></h1>
    <?php
    require('crudForm/addVeterinarianReportForm.php');
    require('crudForm/addHabitatComment.php');
    ?>
    <div class="alert-container">
        <?php
        //Alert veterinarian report  
        if (isset($_COOKIE['ADD_REPORT_SUCCESS']) && $_COOKIE['ADD_REPORT_SUCCESS'] == true) :
        ?>
            <div class="alert alert-success" role="alert">
                Un nouveau compte rendu a été ajouté.
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php elseif (isset($_COOKIE['ADD_REPORT_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <script>
                    document.querySelector('.crud-frame').classList.add('visible');
                    document.querySelector('body').style.overflow = 'hidden';
                </script>
            </div>
        <?php endif; ?>
    </div>
    <div class="animal-flex">
        <img class="animal-img" src="data:image/jpg;base64,<?php echo $animal['image'] ?>" alt="">
        <div class="animal-description">
            <p class="animal-habitat">habitat : <?php echo $animal['habitat'] ?> </p>
            <p class="animal-race">Race : <?php echo $animal['race'] ?> </p>
            <p class="animal-status">Etat de l'animal : <?php echo $animal['status'] ?></p>
            <br>
            <button type="button" data-frame-to-open='report' data-animal-id='<?php echo $animal['id'] ?>' class="button-crud btn-open-frame">Ajouter un compte rendu</button>
            <br>
            <button type="button" data-frame-to-open='habitatComment' data-habitat-name='<?php echo $animal['habitat'] ?>' class="button-crud btn-open-frame">Ajouter un commentaire à son habitat</button>
        </div>
    </div>
    <div class="table-container consump-list">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>type de nourriture</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($consumptionList as $consumption) : ?>
                    <tr>

                        <td><?php echo $consumption['date']; ?></td>
                        <td><?php echo $consumption['foodType']; ?></td>
                        <td><?php echo $consumption['quantity']; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <script src="script\frameScript.js"></script>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>