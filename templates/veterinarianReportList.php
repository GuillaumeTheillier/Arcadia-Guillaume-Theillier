<?php
$title = 'compte rendu';
ob_start();
?>

<main>
    <h1 class="page-title">Compte rendu des vétérinaires</h1>

    <!-- filter -->
    <div class="filter" data-sort="<?php echo $sort; ?>">
        <form action="index.php?action=veterinarianReportList" method="post">
            <!-- Sort by -->
            <div class="input-container">
                <label for="report-list-sort" class="label-input-form">Trier par :</label>
                <select onchange="this.form.submit()" name="reportListSort" id="report-list-sort" class="input-form select-sort">
                    <option value="" disabled></option>
                    <option value="date Asc">Date croissante</option>
                    <option value="date Desc">Date décroissante</option>
                    <option value="animalName Asc">Animal A-Z</option>
                    <option value="animalName Desc">Animal Z-A</option>
                </select>
            </div>
        </form>
        <script src="script/sortScript.js"></script>
        <!-- Date filter -->
        <form action="index.php?action=veterinarianReportList" method="post">
            <div class="input-container">
                <label for="report-list-date-filter" class="label-input-form">Date</label>
                <input type="date" name="reportListDateFilter" id="report-list-date-filter" class="input-form">
            </div>
        </form>
        <!-- Animal filter -->
        <form action="index.php?action=veterinarianReportList" method="post">
            <div class="input-container">
                <label for="report-list-animal-filter" class="label-input-form">Animal</label>
                <select onchange="this.form.submit()" name="reportListAnimalFilter" id="report-list-animal-filter" class="input-form habitat-select">
                    <option value="" disabled></option>
                    <?php foreach ($animal as $ani) : ?>
                        <option value="<?php echo $ani['id'] ?>"><?php echo $ani['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </form>
        <script src="script/filterScript.js"></script>
        <!-- reset filter -->
        <form action="index.php?action=veterinarianReportList" method="post">
            <button type="submit">Effacer filtre</button>
        </form>
    </div>
    <!-- Report list table -->
    <div class="animal-list-container">
        <table class="animal-list">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Animal</th>
                    <th class="raceCol">Type de nourriture</th>
                    <th class="habitatCol">Quantité</th>
                    <th>Détail sur l'état de l'animal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reportList as $report) : ?>
                    <tr class='table-row'>
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