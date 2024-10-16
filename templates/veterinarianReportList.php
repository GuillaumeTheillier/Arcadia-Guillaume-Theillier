<?php
$title = 'compte rendu';
ob_start();
?>

<main>
    <h1 class="page-title">Compte rendu des vétérinaires</h1>

    <!-- filter -->
    <div class="filter" data-sort="<?php echo $sort; ?>" data-animal-filter="<?php echo $animalId; ?>">
        <form action="index.php?action=veterinarianReportList" method="post">
            <!-- Sort by -->
            <div class="input-container">
                <label for="report-list-sort" class="label-input-form">Trier par :</label>
                <select onchange="this.form.submit()" name="reportListSort" id="report-list-sort" class="input-form select-sort">
                    <option value="dateAsc">Date croissante</option>
                    <option value="dateDesc">Date décroissante</option>
                    <option value="animalNameAsc">Animal A-Z</option>
                    <option value="animalNameDesc">Animal Z-A</option>
                </select>
            </div>
            <!-- Date filter -->
            <div class="input-container">
                <label for="report-list-date-filter" class="label-input-form">Date</label>
                <input type="date" name="reportListDateFilter" value="<?php echo $date ?>" id="report-list-date-filter" class="input-form date-filter">
            </div>
            <!-- Animal filter -->
            <div class="input-container">
                <label for="report-list-animal-filter" class="label-input-form">Animal</label>
                <select name="reportListAnimalFilter" id="report-list-animal-filter" class="input-form select-animal">
                    <option value="" selected disabled hidden>choisir un animal</option>
                    <?php foreach ($animal as $ani) : ?>
                        <option value=<?php echo (int)$ani['id'] ?>><?php echo $ani['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <!-- submit filter -->
            <button type="submit">Valider</button>
            <!-- reset filter -->
            <button type="submit" name="clearFilter" value=true>Effacer filtre</button>
        </form>
        <script src="script/reportFilterScript.js"></script>
    </div>
    <!-- veterinarian Report list table -->
    <div class="table-container">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Animal</th>
                    <th>Type de nourriture</th>
                    <th>Quantité</th>
                    <th>Détail sur l'état de l'animal</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($reportList as $report) : ?>
                    <tr>
                        <td><?php echo $report['date']; ?></td>
                        <td><?php echo $report['animalName'] ?></td>
                        <td><?php echo $report['foodType']; ?></td>
                        <td><?php echo $report['quantity']; ?></td>
                        <td><?php echo $report['statusDetail']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>