<?php
$title = 'Ajouter une consommation de nourriture';
ob_start();
?>

<main>
    <h1 class="page-title">Ajouter une consommation de nourriture</h1>
    <!-- Alert -->
    <div class="alert-container">
        <?php if (isset($_COOKIE['ADD_FOOD_ERROR'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_COOKIE['ADD_FOOD_ERROR']; ?>
                <button type='button' class="btn-close ms-auto" data-bs-dismiss='alert'></button>
            </div>
        <?php endif; ?>
    </div>
    <form action="index.php?action=addFoodConsumption" method="post">
        <div class="input-container">
            <label for="food-date" class="label-input-form">Date</label>
            <input type="datetime-local" name="foodDate" id="food-date" class="input-form" required>
        </div>
        <div class="input-container">
            <label for="food-type" class="label-input-form">Type de nourriture</label>
            <input type="text" name="foodType" id="food-type" class="input-form" required>
        </div>
        <div class="input-container">
            <label for="food-quantity" class="label-input-form">Quantité</label>
            <input type="text" name="foodQuantity" id="food-quantity" class="input-form" required>
        </div>
        <input type="text" name="animalId" id="animal-id" hidden value="<?php echo $animalId; ?>">
        <button type="submit">Ajouter</button>
    </form>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>