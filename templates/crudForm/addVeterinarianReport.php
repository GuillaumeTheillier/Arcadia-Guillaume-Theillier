<div class="create-form-container">
    <div class="crud-frame">
        <button type='button' class="btn-close btn-close-frame"></button>

        <h4 class="crud-frame-title">Ajouter un compte rendu</h4>

        <div class="alert-container">
            <?php if (isset($_COOKIE['ADD_REPORT_ERROR'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_COOKIE['ADD_REPORT_ERROR']; ?>
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
        </div>

        <form action="index.php?action=addAnimalReport" method="post">
            <div class="input-container">
                <label for="add-report-date" class="label-input-form">Date de passage</label>
                <input type="datetime-local" class="input-form" name="addReportDate" id="add-report-date" maxlength="50" required>
            </div>
            <div class="input-container">
                <label for="add-report-status" class="label-input-form">Etat de l'animal</label>
                <input type="text" class="input-form" name="addReportStatus" id="add-report-status" maxlength="50" required>
            </div>
            <div class="input-container">
                <label for="add-report-food" class="label-input-form">Nourriture à proposer</label>
                <input type="text" class="input-form" name="addReportFood" id="add-report-food" maxlength="50" required>
            </div>
            <div class="input-container">
                <label for="add-report-quantity" class="label-input-form">Grammage nourriture</label>
                <input type="text" class="input-form" name="addReportQuantity" id="add-report-quantity" maxlength="50" required>
            </div>
            <div class="input-container">
                <label for="add-report-status-detail" class="label-input-form">Détail sur l'état de l'animal (facultatif)</label>
                <input type="text" class="input-form" name="addReportStatusDetail" id="add-report-status-detail" maxlength="200">
            </div>
            <button type="submit" name="animalId" value="<?php echo $animal['id'] ?>">Confirmer</button>
        </form>
    </div>
</div>