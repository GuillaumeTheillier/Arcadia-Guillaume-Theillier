<?php
$title = 'Liste des animaux';
ob_start();
?>

<main>
    <h1 class="page-title">Liste des animaux</h1>

    <?php
    if ($_SESSION['ROLE_USER'] === 1) {
        require('crudForm/addFoodConsumptionForm.php');
    } else if ($_SESSION['ROLE_USER'] === 2) {
        require('crudForm/addVeterinarianReportForm.php');
    }
    ?>

    <!-- Alert -->
    <div class="alert-container">
        <?php // Alert Food consumption
        if (isset($_COOKIE['ADD_FOOD_SUCCESS']) && $_COOKIE['ADD_FOOD_SUCCESS'] == true) :
        ?>
            <div class="alert alert-success" role="alert">
                Une nouvelle consommation de nourriture a été ajouté.
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php elseif (isset($_COOKIE['ADD_FOOD_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <script>
                    document.querySelector('.crud-frame').classList.add('visible');
                    document.querySelector('body').style.overflow = 'hidden';
                </script>
            </div>
        <?php endif; ?>
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
    <!-- Filter -->
    <div class="filter" data-filter-type="<?php echo $filter['type']; ?>" data-filter-id="<?php echo $filter['id']; ?>">
        <div class="filter-grid">
            <form action="index.php?action=animalList" method="post">
                <!-- Habitat filter -->
                <div class="input-container">
                    <label for="animal-list-habitat-filter" class="label-input-form">Habitat</label>
                    <select onchange="this.form.submit()" name="animalListHabitatFilter" id="animal-list-habitat-filter" class="input-form habitat-select">
                        <option value="" disabled hidden>choisir un habitat</option>
                        <?php foreach ($habitatList as $hab) : ?>
                            <option value="<?php echo $hab['id'] ?>"><?php echo $hab['nom'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </form>
            <form action="index.php?action=animalList" method="post">
                <!-- Race filter -->
                <div class="input-container">
                    <label for="animal-list-race-filter" class="label-input-form">Race</label>
                    <select onchange="this.form.submit()" name="animalListRaceFilter" id="animal-list-race-filter" class="input-form race-select">
                        <option value="" disabled hidden>choisir une race</option>
                        <?php foreach ($raceList as $race) : ?>
                            <option value="<?php echo $race['id'] ?>"><?php echo $race['label'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </form>
            <form action="index.php?action=animalList" method="post">
                <!-- reset filter -->
                <button type="submit">Effacer filtre</button>
            </form>
        </div>
    </div>
    <!-- animal list table -->
    <div class="table-container animal-list">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th class="race-col">Race</th>
                    <th class="habitat-col">Habitat</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($animalList as $animal) : ?>
                    <?php if ($_SESSION['ROLE_USER'] === 1) : ?>
                        <tr>
                            <td><?php echo $animal['name']; ?></td>
                            <td><?php echo $animal['race']; ?></td>
                            <td><?php echo $animal['habitat']; ?></td>
                            <td>
                                <button type="button" data-animal-id="<?php echo $animal['id']; ?>" class="button-crud btn-open-frame">Ajouter une consommation</button>
                            </td>
                        </tr>
                    <?php elseif ($_SESSION['ROLE_USER'] === 2) : ?>
                        <tr>
                            <td class="click-row" onclick="document.location.href='index.php?action=animalConsumptionList&animal=<?php echo htmlspecialchars($animal['id']) ?>'"><?php echo $animal['name']; ?></td>
                            <td class="click-row race-col" onclick="document.location.href='index.php?action=animalConsumptionList&animal=<?php echo htmlspecialchars($animal['id']) ?>'"><?php echo $animal['race']; ?></td>
                            <td class="click-row habitat-col" onclick="document.location.href='index.php?action=animalConsumptionList&animal=<?php echo htmlspecialchars($animal['id']) ?>'"><?php echo $animal['habitat']; ?></td>
                            <td>
                                <button type="button" data-animal-id="<?php echo $animal['id']; ?>" class="button-crud btn-open-frame">Ajouter un compte rendu</button>
                            </td>
                        </tr>
                    <?php endif ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="script/filterScript.js"></script>
    <script src="script/frameScript.js"></script>
</main>

<?php
$content = ob_get_clean();
require('templates/layout.php');
?>