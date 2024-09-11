<?php
$title = 'Ajouter une consommation de nourriture';
ob_start();
?>

<main>
    <h1 class="page-title">Ajouter une consommation de nourriture</h1>
    <form action="index.php?action=addFoodConsumption" method="post">
        <div class="input-container">
            <label for="food-date" class="label-input-form">Date</label>
            <!--<input type="date" name="foodDate" id="food-date" class="input-form" required>
            <input type="time" name="foodDate" id="food-date" class="input-form" required>-->
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
        <input type="text" name="animalId" id="animal-id" hidden value="1">
        <button type="submit">Ajouter</button>
    </form>
</main>

<?php
$content = ob_get_clean();
require('layout.php');
?>