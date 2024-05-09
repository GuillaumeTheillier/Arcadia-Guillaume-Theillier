<div id="cadre">
    <button type='button' class="btn-close" id="btn-crud-close"></button>

    <form action="index.php?action=submitNewAccount" method="post">
        <div class="input-container">
            <label for="username" class="label-input-form">Nom d'utilisateur</label>
            <input type="text" class="input-form" name="username" id="username" value="<?php echo $account['surname'] ?>">
        </div>
        <div class="input-container">
            <label for="surname" class="label-input-form">Nom</label>
            <input type="text" class="input-form" name="surname" id="surname">
        </div>
        <div class="input-container">
            <label for="firstName" class="label-input-form">Prénom</label>
            <input type="text" class="input-form" name="firstName" id="firstName">
        </div>
        <div class="input-container">
            <label for="role" class="label-input-form">Rôle</label>
            <select name="role" id="role" class="input-form">
                <option value="employee">Employé</option>
                <option value="veterinarian">Vétérinaire</option>
            </select>
        </div>
        <div class="input-container">
            <label for="password" class="label-input-form">Mot de passe</label>
            <input type="password" class="input-form" name="password" id="password">
        </div>

        <button type="submit">Confirmer</button>
    </form>
</div>