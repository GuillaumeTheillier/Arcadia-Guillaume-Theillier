<div class="create-form-container">
    <div class="crud-frame" data-frame-name="habitatComment">
        <button type='button' class="btn-close btn-close-frame"></button>

        <h4 class="crud-frame-title">Ajouter un commentaire à un habitat</h4>

        <div class="alert-container">
            <?php if (isset($_COOKIE['ADD_HABITAT_COMMENT_ERROR'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_COOKIE['ADD_HABITAT_COMMENT_ERROR']; ?>
                    <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
                </div>
            <?php endif; ?>
        </div>

        <form action="index.php?action=addAHabitatComment" method="post">
            <div class="input-container">
                <label for="add-habitat-comment" class="label-input-form"></label>
                <input type="text" class="input-form" name="addHabitatComment" id="add-habitat-comment" maxlength="255" required>
            </div>
            <button type="submit" name="habitatId" class="submitFrameBtn" value="<?php echo $animal['habitat'] ?>">Confirmer</button>
        </form>
    </div>
</div>