<?php
$title = 'Liste des animaux';
ob_start();
?>

<main>
    <h1 class="page-title">Liste des animaux</h1>

    <?php require('crudForm/addAnimalReport.php'); ?>

    <!-- Alert -->
    <div class="alert-container">
        <?php if (isset($_COOKIE['ADD_FOOD_SUCCESS']) && $_COOKIE['ADD_FOOD_SUCCESS'] == true) : ?>
            <div class="alert alert-success" role="alert">
                Une nouvelle consommation de nourriture a été ajouté.
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php elseif (isset($_COOKIE['ADD_FOOD_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['ADD_FOOD_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Filter -->
    <div class="filter">
        <form action="index.php?action=animalList" method="post">
            <!-- Race filter -->
            <div class="input-container">
                <label for="update-animal-race" class="label-input-form">Race</label>
                <select onchange="this.form.submit()" name="animalListRaceFilter" id="update-animal-race" class="input-form" required>
                    <option value="" disabled></option>
                    <?php foreach ($raceList as $race) : ?>
                        <?php if ($race['label'] === $animalList[0]['race']) : ?>
                            <option value="<?php echo $race['id'] ?>" selected><?php echo $race['label'] ?></option>
                        <?php else: ?>
                            <option value="<?php echo $race['id'] ?>"><?php echo $race['label'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
            </div>
        </form>
        <!-- Habitat filter -->
        <form action="index.php?action=animalList" method="post">
            <div class="input-container">
                <label for="update-animal-habitat" class="label-input-form">Habitat</label>
                <select onchange="this.form.submit()" name="animalListHabitatFilter" id="update-animal-habitat" class="input-form" required>
                    <option value="" disabled></option>
                    <?php foreach ($habitatList as $hab) : ?>
                        <?php if ($hab['nom'] === $animalList[0]['habitat']) : ?>
                            <option value="<?php echo $hab['id'] ?>" selected><?php echo $hab['nom'] ?></option>
                        <?php else: ?>
                            <option value="<?php echo $hab['id'] ?>"><?php echo $hab['nom'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
            </div>
        </form>
        <form action="index.php?action=animalList" method="post">
            <button type="submit">Effacer filtre</button>
        </form>
    </div>

    <div class="animal-list-container">
        <table class="animal-list">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>race</th>
                    <th>habitat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($animalList as $animal) : ?>
                    <tr class='table-row'>
                        <?php if ($_SESSION['ROLE_USER'] == 1) : ?>
                            <td><?php echo $animal['name']; ?></td>
                            <td><?php echo $animal['race']; ?></td>
                            <td><?php echo $animal['habitat']; ?></td>
                            <td>
                                <form class="animal-list-button" method="post">
                                    <button type="submit" name="animalId" class="button-crud" value="<?php echo $animal['id'] ?>" formaction="index.php?action=foodConsumptionForm">Ajouter une consommation</button>
                                </form>
                            </td>
                    </tr>
                <?php elseif ($_SESSION['ROLE_USER'] == 2) : ?>
                    <!--<a href="index.php?action=animalConsumptionList"></a>-->
                    <tr onclick="document.location.href='index.php?action=animalConsumptionList&animal=<?php echo $animal['id'] ?>'" class='table-row row-click'>
                        <td><?php echo $animal['name']; ?></td>
                        <td><?php echo $animal['race']; ?></td>
                        <td><?php echo $animal['habitat']; ?></td>
                        <td>
                            <form class="animal-list-button" method="post">
                                <!--<button type="submit" name="animalId" class="button-crud" value="<?php echo $animal['id'] ?>" formaction="index.php?action=reportForm">Ajouter un compte rendu</button>
                --><button type="button" class="button-crud btn-open-frame">Ajouter un compte rendu</button>
                            </form>
                        </td>
                    </tr>
                <?php endif ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="script\frameScript.js"></script>
</main>

<?php
$content = ob_get_clean();
require('templates/layout.php');
?>